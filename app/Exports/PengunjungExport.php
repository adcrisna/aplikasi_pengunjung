<?php

namespace App\Exports;

use App\Models\Pengunjung;
use Illuminate\Contracts\View\View;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;

class PengunjungExport implements FromView,ShouldAutoSize,WithColumnFormatting,WithCustomValueBinder
{
    private $date;

     public function __construct($tanggal)
    {
        $this->tanggal = $tanggal;
    }

    // public function drawings()
    // {
    //     $drawing = new Drawing();
    //     $drawing->setName('Logo');
    //     $drawing->setDescription('This is my logo');
    //     $drawing->setPath(public_path('/logo.png'));
    //     $drawing->setHeight(90);
    //     $drawing->setCoordinates('A1');

    //     return $drawing;
    // }
    public function view(): View
    {
        $tanggal = $this->tanggal;
        return view('excel.pengunjung', [
            'januariTotal' => Pengunjung::whereMonth('created_at',1)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'januariPelajar' => Pengunjung::where('kategori_pengunjung','Pelajar')->whereMonth('created_at',1)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'januariUmum' => Pengunjung::where('kategori_pengunjung','Wisatawan Umum')->whereMonth('created_at',1)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'januariAsing' => Pengunjung::where('kategori_pengunjung','Wisatawan Umum')->whereMonth('created_at',1)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'februariTotal' => Pengunjung::whereMonth('created_at',2)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'februariPelajar' => Pengunjung::where('kategori_pengunjung','Pelajar')->whereMonth('created_at',2)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'februariUmum' => Pengunjung::where('kategori_pengunjung','Wisatawan Umum')->whereMonth('created_at',2)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'februariAsing' => Pengunjung::where('kategori_pengunjung','Wisatawan Umum')->whereMonth('created_at',2)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'maretTotal' => Pengunjung::whereMonth('created_at',3)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'maretPelajar' => Pengunjung::where('kategori_pengunjung','Pelajar')->whereMonth('created_at',3)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'maretUmum' => Pengunjung::where('kategori_pengunjung','Wisatawan Umum')->whereMonth('created_at',3)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'maretAsing' => Pengunjung::where('kategori_pengunjung','Wisatawan Umum')->whereMonth('created_at',3)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'aprilTotal' => Pengunjung::whereMonth('created_at',4)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'aprilPelajar' => Pengunjung::where('kategori_pengunjung','Pelajar')->whereMonth('created_at',4)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'aprilUmum' => Pengunjung::where('kategori_pengunjung','Wisatawan Umum')->whereMonth('created_at',4)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'aprilAsing' => Pengunjung::where('kategori_pengunjung','Wisatawan Umum')->whereMonth('created_at',4)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'meiTotal' => Pengunjung::whereMonth('created_at',5)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'meiPelajar' => Pengunjung::where('kategori_pengunjung','Pelajar')->whereMonth('created_at',5)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'meiUmum' => Pengunjung::where('kategori_pengunjung','Wisatawan Umum')->whereMonth('created_at',5)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'meiAsing' => Pengunjung::where('kategori_pengunjung','Wisatawan Umum')->whereMonth('created_at',5)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'juniTotal' => Pengunjung::whereMonth('created_at',6)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'juniPelajar' => Pengunjung::where('kategori_pengunjung','Pelajar')->whereMonth('created_at',6)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'juniUmum' => Pengunjung::where('kategori_pengunjung','Wisatawan Umum')->whereMonth('created_at',6)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'juniAsing' => Pengunjung::where('kategori_pengunjung','Wisatawan Umum')->whereMonth('created_at',6)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'juliTotal' => Pengunjung::whereMonth('created_at',7)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'juliPelajar' => Pengunjung::where('kategori_pengunjung','Pelajar')->whereMonth('created_at',7)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'juliUmum' => Pengunjung::where('kategori_pengunjung','Wisatawan Umum')->whereMonth('created_at',7)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'juliAsing' => Pengunjung::where('kategori_pengunjung','Wisatawan Umum')->whereMonth('created_at',7)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'agustusTotal' => Pengunjung::whereMonth('created_at',8)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'agustusPelajar' => Pengunjung::where('kategori_pengunjung','Pelajar')->whereMonth('created_at', 8)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'agustusUmum' => Pengunjung::where('kategori_pengunjung','Wisatawan Umum')->whereMonth('created_at',8)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'agustusAsing' => Pengunjung::where('kategori_pengunjung','Wisatawan Umum')->whereMonth('created_at',8)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'septemberTotal' => Pengunjung::whereMonth('created_at',9)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'septemberPelajar' => Pengunjung::where('kategori_pengunjung','Pelajar')->whereMonth('created_at',9)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'septemberUmum' => Pengunjung::where('kategori_pengunjung','Wisatawan Umum')->whereMonth('created_at',9)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'septemberAsing' => Pengunjung::where('kategori_pengunjung','Wisatawan Umum')->whereMonth('created_at',9)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'oktoberTotal' => Pengunjung::whereMonth('created_at',10)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'oktoberPelajar' => Pengunjung::where('kategori_pengunjung','Pelajar')->whereMonth('created_at',10)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'oktoberUmum' => Pengunjung::where('kategori_pengunjung','Wisatawan Umum')->whereMonth('created_at',10)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'oktoberAsing' => Pengunjung::where('kategori_pengunjung','Wisatawan Umum')->whereMonth('created_at',10)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'novemberTotal' => Pengunjung::whereMonth('created_at',11)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'novemberPelajar' => Pengunjung::where('kategori_pengunjung','Pelajar')->whereMonth('created_at',11)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'novemberUmum' => Pengunjung::where('kategori_pengunjung','Wisatawan Umum')->whereMonth('created_at',11)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'novemberAsing' => Pengunjung::where('kategori_pengunjung','Wisatawan Umum')->whereMonth('created_at',11)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'desemberTotal' => Pengunjung::whereMonth('created_at',12)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'desemberPelajar' => Pengunjung::where('kategori_pengunjung','Pelajar')->whereMonth('created_at',12)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'desemberUmum' => Pengunjung::where('kategori_pengunjung','Wisatawan Umum')->whereMonth('created_at',12)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'desemberAsing' => Pengunjung::where('kategori_pengunjung','Wisatawan Umum')->whereMonth('created_at',12)->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'tahun' => date("Y", strtotime($tanggal)),
            'total' => Pengunjung::whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'totalPelajar' => Pengunjung::where('kategori_pengunjung','Pelajar')->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'totalUmum' => Pengunjung::where('kategori_pengunjung','Wisatawan Umum')->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),
            'totalAsing' => Pengunjung::where('kategori_pengunjung','Wisatawan Umum')->whereYear('created_at',date("Y", strtotime($tanggal)))->count(),

        ]);
    }

    public function bindValue(Cell $cell, $value)
    {
        $cell->setValueExplicit($value, DataType::TYPE_STRING);
        return true;

    }

    public function columnFormats(): array
    {
        return [
            'G' => NumberFormat::FORMAT_TEXT,
        ];
    }
}
