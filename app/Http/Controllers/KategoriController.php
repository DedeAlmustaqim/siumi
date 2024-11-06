<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function allKategori()
    {
        $kategori = DB::table('kategori')->get();
        $data = [
            'title' => 'Semua Kategori',
            'kategori' => $kategori,
        ];
        return view('all_kategori', $data);
    }

    public function kategori($id)
    {

        $kategori = DB::table('kategori')->where('id', $id)->first();

        $data = [
            'title' => $kategori->nama_kategori,
            'kategori' => $kategori,
        ];
        return view('kategori', $data);
    }

    public function getProductsByCategory(Request $request, $id): JsonResponse
    {
        $sort = $request->input('sort');
        $perPage = 8;

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
            ->where('produk_umkm.kategori_id',$id)
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
