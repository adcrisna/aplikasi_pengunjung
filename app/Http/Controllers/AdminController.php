<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;
use Auth;
use DB;
use App\Models\User;
use App\Models\pengunjung;
use App\Models\Analisis;
use MathPHP\LinearAlgebra\MatrixFactory;
use MathPHP\Statistics\Statistic;
use Phpml\Preprocessing\Normalizer;
use Phpml\Regression\Ridge;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PengunjungExport;

class AdminController extends Controller
{
    public function index() {
        $title = "Dashboard";
        $getWanita = Pengunjung::where('jenis_kelamin','Wanita')->whereYear('created_at',date('Y'))->count();
        $getPria = Pengunjung::where('jenis_kelamin','Pria')->whereYear('created_at',date('Y'))->count();
        $getPelajar = Pengunjung::where('kategori_pengunjung','Pelajar')->whereYear('created_at',date('Y'))->count();
        $getUmum = Pengunjung::where('kategori_pengunjung','Wisatawan Umum')->whereYear('created_at',date('Y'))->count();
        $getAsing = Pengunjung::where('kategori_pengunjung','Wisatawan Asing')->whereYear('created_at',date('Y'))->count();
        return view('admin.index', compact('title','getWanita','getPria','getPelajar','getUmum','getAsing'));
    }
    public function profile()
    {
        $title = 'Profile';
        $admin = User::find(Auth::user()->id);
        return view('admin.profile', compact('title','admin'));
    }
    public function updateProfile(Request $request){
        DB::beginTransaction();
        try {
            if (!empty($request->password)) {
                $user = User::find($request->id);
                $user->name = $request->name;
                $user->email = $request->email;
                $user->no_hp = $request->no_hp;
                $user->alamat = $request->alamat;
                $user->password = bcrypt($request->password);
                $user->save();
            }else{
                $user = User::find($request->id);
                $user->name = $request->name;
                $user->email = $request->email;
                $user->no_hp = $request->no_hp;
                $user->alamat = $request->alamat;
                $user->save();
            }
             DB::commit();
            \Session::flash('msg_success','Profile Berhasil Diubah!');
            return Redirect::route('admin.profile');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.profile');
        }
    }
    public function pengunjung()
    {
        $title = 'Data Pengunjung';
        $pengunjung = Pengunjung::orderBy('id','DESC')->get();
        return view('admin.pengunjung', compact('title','pengunjung'));
    }
    public function deletePengunjung($id)
    {
        DB::beginTransaction();
        try {
            $pengunjung = Pengunjung::where('id',$id)->delete();

            DB::commit();
            \Session::flash('msg_success','Data Pengunjung Berhasil Dihapus!');
            return Redirect::route('admin.pengunjung');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.pengunjung');
        }
    }
    public function truncatePengunjung()
    {

        try {
            $pengunjung = Pengunjung::truncate();

            \Session::flash('msg_success','Semua Data Pengunjung Berhasil Dihapus!');
            return Redirect::route('admin.pengunjung');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.pengunjung');
        }
    }
    public function addAnalisis(Request $request)
    {
        DB::beginTransaction();
        try {
                $startDate = Carbon::parse($request->startDate)->startOfDay();
                $endDate = Carbon::parse($request->endDate)->endOfDay();
                // Ambil total data pengunjung dari database berdasarkan kategori dan bulanan
                $totals = DB::table('pengunjungs')
                    ->select(
                        DB::raw('SUM(CASE WHEN kategori_pengunjung = "Pelajar" THEN 1 ELSE 0 END) as total_pelajar'),
                        DB::raw('SUM(CASE WHEN kategori_pengunjung = "Wisatawan Umum" THEN 1 ELSE 0 END) as total_umum'),
                        DB::raw('SUM(CASE WHEN kategori_pengunjung = "Wisatawan Asing" THEN 1 ELSE 0 END) as total_asing'),
                        DB::raw('COUNT(*) as total_pengunjung'),
                        DB::raw('MONTH(created_at) as month')
                    )
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->groupBy(DB::raw('MONTH(created_at)'))
                    ->get();

                // Cek apakah data tersedia
                if ($totals->isEmpty()) {
                    \Session::flash('msg_error','Data pengunjung tidak tersedia!');
                    return Redirect::route('admin.pengunjung');
                }

                // Ambil data harian pengunjung dari database
                $pengunjung = DB::table('pengunjungs')
                    ->select(
                        DB::raw('DATE(created_at) as date'),
                        DB::raw('SUM(CASE WHEN kategori_pengunjung = "Pelajar" THEN 1 ELSE 0 END) as pelajar'),
                        DB::raw('SUM(CASE WHEN kategori_pengunjung = "Wisatawan Umum" THEN 1 ELSE 0 END) as umum'),
                        DB::raw('SUM(CASE WHEN kategori_pengunjung = "Wisatawan Asing" THEN 1 ELSE 0 END) as asing'),
                        DB::raw('COUNT(*) as jumlah')
                    )
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->groupBy(DB::raw('DATE(created_at)'))
                    ->get();

                if ($pengunjung->isEmpty()) {
                    \Session::flash('msg_error','Data pengunjung tidak tersedia!');
                    return Redirect::route('admin.pengunjung');
                }

                // Mengisi array X dan Y
                $X = [];
                $Y = [];

                foreach ($pengunjung as $row) {
                    $X[] = [1, $row->pelajar, $row->umum, $row->asing]; // Tambahkan 1 untuk intercept
                    $Y[] = $row->jumlah;
                }

                // Mengubah array menjadi matriks
                $X = MatrixFactory::create($X);
                $Y = MatrixFactory::create([$Y])->transpose(); // Y harus berupa vektor kolom

                // Cek ukuran matriks
                if ($X->getM() !== $Y->getM()) {
                    \Session::flash('msg_error','Dimensi matriks X dan Y tidak sesuai!');
                    return Redirect::route('admin.pengunjung');
                }

                // Hitung koefisien regresi
                $Xt = $X->transpose();
                $XtX = $Xt->multiply($X);

                // Cek apakah matriks XtX adalah singular
                if ($XtX->det() == 0) {
                    \Session::flash('msg_error','Matriks adalah singular dan tidak bisa di-invers!');
                    return Redirect::route('admin.pengunjung');
                }

                $XtX_inv = $XtX->inverse();
                $XtY = $Xt->multiply($Y);
                $B = $XtX_inv->multiply($XtY);

                $coefficients = $B->getColumn(0);
                $coefficients_str = implode(', ', $coefficients);

                // Hitung rata-rata bulanan untuk prediksi
                $monthsCount = $totals->count();
                $pelajarAvg = $totals->sum('total_pelajar') / $monthsCount;
                $umumAvg = $totals->sum('total_umum') / $monthsCount;
                $asingAvg = $totals->sum('total_asing') / $monthsCount;

                // Prediksi jumlah pengunjung untuk data baru
                $new_data = [1, $pelajarAvg, $umumAvg, $asingAvg]; // Tambahkan 1 untuk intercept
                $prediction = 0;
                foreach ($coefficients as $i => $coefficient) {
                    $prediction += $coefficient * $new_data[$i];
                }

                //save data
                $analisis = new Analisis;
                $analisis->start_date = $startDate;
                $analisis->end_date = $endDate;
                $analisis->pelajar = $totals->sum('total_pelajar');
                $analisis->umum = $totals->sum('total_umum');
                $analisis->asing = $totals->sum('total_asing');
                $analisis->total = $totals->sum('total_pengunjung');
                $analisis->prediksi = $prediction;
                $analisis->koefisien = $coefficients_str;
                $analisis->save();

             DB::commit();
            \Session::flash('msg_success','Analisis Berhasil!');
            return Redirect::route('admin.pengunjung');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.pengunjung');
        }
    }
    public function analisis()
    {
        $title = 'Data Analisis Pengunjung';
        $analisis = Analisis::orderBy('id', 'DESC')->take(12)->get();
        return view('admin.analisis', compact('title','analisis'));
    }
    public function deleteAnalisis($id)
    {
        DB::beginTransaction();
        try {
            $analisis = Analisis::where('id',$id)->delete();

            DB::commit();
            \Session::flash('msg_success','Data Analisis Berhasil Dihapus!');
            return Redirect::route('admin.analisis');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.analisis');
        }
    }
    public function laporanAnalisis(Request $request) {
        return Excel::download(new PengunjungExport($request->tanggal), 'laporan_pengunjung_ '.date("Y", strtotime($request->tanggal)).'.xlsx');
    }
    public function admin() {
        $title = 'Data Admin';
        $admin = User::whereNot('id',1)->get();
        return view('admin.admin', compact('title','admin'));
    }
    public function addAdmin(Request $request)
    {
        // return $request;
       DB::beginTransaction();
        try {
            $admin = new User;
            $admin->name = $request->name;
            $admin->email = $request->email;
            $admin->no_hp = $request->no_hp;
            $admin->alamat = $request->alamat;
            $admin->password = bcrypt($request->password);
            $admin->level = 'Admin';
            $admin->save();

             DB::commit();
            \Session::flash('msg_success','Admin Berhasil Ditambah!');
            return Redirect::route('admin.admin');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.admin');
        }
    }
    public function updateAdmin(Request $request)
    {
        // return $request;
       DB::beginTransaction();
        try {
                if (empty($request->password)) {
                    $user = User::find($request->id);
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->no_hp = $request->no_hp;
                    $user->alamat = $request->alamat;
                    $user->save();
                }else {
                    $user = User::find($request->id);
                    $user->name = $request->name;
                    $user->email = $request->email;
                    $user->no_hp = $request->no_hp;
                    $user->alamat = $request->alamat;
                    $user->password = bcrypt($request->password);
                    $user->save();
                }
             DB::commit();
            \Session::flash('msg_success','Admin Berhasil Diubah!');
            return Redirect::route('admin.admin');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.admin');
        }
    }
    public function deleteAdmin($id)
    {
        DB::beginTransaction();
        try {
            $admin = User::where('id',$id)->delete();
            DB::commit();
            \Session::flash('msg_success','Data Admin Berhasil Dihapus!');
            return Redirect::route('admin.admin');

        } catch (Exception $e) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('admin.admin');
        }
    }
}
