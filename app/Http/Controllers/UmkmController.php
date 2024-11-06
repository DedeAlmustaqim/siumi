<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class UmkmController extends Controller
{
    public function allUmkm()
    {
        $umkm = DB::table('umkm')->get();
        $data = [
            'title' => 'Semua Umkm',
            'umkm' => $umkm,
        ];
        return view('all_umkm', $data);
    }

    public function getUmkm(Request $request): JsonResponse
    {
        $perPage = 6;

        $data = DB::table('umkm')
            ->paginate($perPage);
        if ($data->isNotEmpty()) {
            return response()->json($data, Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Not found'], Response::HTTP_NOT_FOUND);
        }
    }

    public function umkmById($id)
    {
        $umkm = DB::table('umkm')->where('id', $id)->first();
        $data = [
            'title' => $umkm->nama_umkm,
            'umkm' => $umkm,
        ];
        return view('umkm_profil', $data);
    }

    public function getProductsByUmkm(Request $request, $id): JsonResponse
    {
        $sort = $request->input('sort');
        $perPage = 4;

        $data = DB::table('produk_umkm')
            ->select(
                'produk_umkm.id',
                'produk_umkm.nama_produk',
                'produk_umkm.deskripsi',
                'produk_umkm.harga',
                'produk_umkm.stok',
                'produk_umkm.kategori_id',
                'produk_umkm.umkm_id',
                'produk_umkm.gambar_produk',
                'produk_umkm.status_produk',
                'produk_umkm.views',
                'umkm.nama_umkm',
                'umkm.img_umkm',
                'umkm.alamat',
                'umkm.no_telp',
                'kategori.nama_kategori',
                'kategori.deskripsi'
            )
            ->where('produk_umkm.umkm_id',$id)
            ->join('umkm', 'produk_umkm.umkm_id', '=', 'umkm.id')
            ->join('kategori', 'produk_umkm.kategori_id', '=', 'kategori.id')

            // Default sorting by product ID if no sort parameter is provided
            ->when(empty($sort), function ($query) {
                return $query->orderBy('produk_umkm.id', 'asc');
            })

            // Conditional sorting based on the sort parameter
            ->when($sort === 'order', function ($query) {
                return $query->orderBy('produk_umkm.id', 'asc');
            })
            ->when($sort === 'popularity', function ($query) {
                return $query->orderBy('produk_umkm.views', 'desc'); // Sort by views in descending order (most popular first)
            })
            ->when($sort === 'price', function ($query) {
                return $query->orderBy('produk_umkm.harga', 'asc'); // Sort by price in ascending order (cheapest first)
            })
            ->when($sort === 'date', function ($query) {
                return $query->orderBy('produk_umkm.created_at', 'desc'); // Sort by date added in descending order (newest first)
            })
            ->when($sort === 'price-desc', function ($query) {
                return $query->orderBy('produk_umkm.harga', 'desc'); // Sort by price in descending order (most expensive first)
            })
            ->paginate($perPage);





        if ($data->isNotEmpty()) {
            return response()->json($data, Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Not found'], Response::HTTP_NOT_FOUND);
        }
}
}