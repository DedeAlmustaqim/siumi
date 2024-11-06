<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class TransaksiController extends Controller
{
    public function checkout()
    {
        $data = [
            'title' => 'Pesanan'
        ];
        return view('admin/pesanan', $data);
    }

    public function getDatatables()
    {
       $data = DB::table('checkout')
            ->select(
                'checkout.nama', 
	'checkout.no_hp_co', 
	'checkout.catatan', 
	'checkout.alamat', 
	'checkout.kabupaten', 
	'checkout.kecamatan', 
	'checkout.kelurahan', 
	'checkout.id', 
	'checkout.created_at', 
	'checkout.kuantitas', 
	'checkout.total', 
	'checkout.produk_id', 
	'produk_umkm.nama_produk', 
	'produk_umkm.harga', 
	'produk_umkm.umkm_id', 
	'produk_umkm.gambar_produk', 
	'umkm.nama_umkm'
            )
            ->join('produk_umkm', 'checkout.produk_id', '=', 'produk_umkm.id')
            ->join('umkm', 'produk_umkm.umkm_id', '=', 'umkm.id')

            ->orderBy('checkout.id', 'ASC')
            
            ->get();
        return DataTables::of($data)
            ->rawColumns(['action'])
            ->make(true);
    }
}
