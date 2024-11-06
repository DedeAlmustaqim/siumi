<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{
    public function index()
    {
        $countUmkm = DB::table('umkm')->count();
        $countProduk = DB::table('produk_umkm')->count();

        $dataUmkm = DB::table('produk_umkm')
    ->join('umkm', 'produk_umkm.umkm_id', '=', 'umkm.id')
    ->select('umkm.nama_umkm', DB::raw('COUNT(produk_umkm.id) as jumlah_produk'), 'umkm.img_umkm', 'umkm.pemilik')
    ->groupBy('umkm.nama_umkm', 'umkm.img_umkm', 'umkm.pemilik')
    ->orderBy('jumlah_produk', 'DESC')
    ->get();
;
        $data = [
            'title' => 'Dashboard',
            'countUmkm' => $countUmkm,
            'countProduk' => $countProduk,
            'umkm' => $dataUmkm,
        ];
        return view('admin/dashboard', $data);
    }
}
