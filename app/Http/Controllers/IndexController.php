<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pengunjung;
use DB;
use Redirect;

class IndexController extends Controller
{
    public function index() {
        $title = "Selamat Datang";
        return view('index', compact('title'));
    }
    public function pengunjung() {
        $title = "Form Pengunjung";
        return view('pengunjung', compact('title'));
    }
    public function addPengunjung(Request $request) {
        DB::beginTransaction();
        try {
            $pengunjung = new Pengunjung;
            $pengunjung->name = $request->name;
            $pengunjung->jenis_kelamin = $request->jenis_kelamin;
            $pengunjung->kategori_usia = $request->kategori_usia;
            $pengunjung->kategori_pengunjung = $request->kategori_pengunjung;
            $pengunjung->save();

            DB::commit();
            \Session::flash('msg_success','Data Pengunjung Berhasil Disimpan!');
            return Redirect::route('pengunjung');
        } catch (\Throwable $th) {
            DB::rollback();
            \Session::flash('msg_error','Somethings Wrong!');
            return Redirect::route('pengunjung');
        }
    }
}
