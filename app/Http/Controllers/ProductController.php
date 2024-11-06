<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'SiUMiBarTim'
        ];
        return view('welcome', $data);
    }

    public function getProducts(Request $request): JsonResponse
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

    public function productById($id)
    {
        $galeri = DB::table('galeri_produk')->where('produk_id', $id)->get();

        $product = DB::table('produk_umkm')
            ->select(
                'produk_umkm.id',
                'produk_umkm.nama_produk',
                'produk_umkm.deskripsi',
                'produk_umkm.harga',
                'produk_umkm.stok',
                'produk_umkm.kategori_id as kategori_id',
                'produk_umkm.umkm_id',
                'produk_umkm.created_at',
                'produk_umkm.updated_at',
                'produk_umkm.gambar_produk',
                'produk_umkm.status_produk',
                'produk_umkm.views',
                'kategori.nama_kategori',
                'umkm.nama_umkm',
                'umkm.img_umkm',
                'umkm.pemilik',
                'umkm.alamat',
                'umkm.no_telp',
                
            )
            ->join('umkm', 'produk_umkm.umkm_id', '=', 'umkm.id')
            ->join('kategori', 'produk_umkm.kategori_id', '=', 'kategori.id')
            ->where('produk_umkm.id', $id)->first();


        $produkUmkm = DB::table('produk_umkm')
            ->select(
                'produk_umkm.id',
                'produk_umkm.nama_produk',
                'produk_umkm.harga',
                'produk_umkm.deskripsi',
                'produk_umkm.gambar_produk'
            )
            ->where('umkm_id', $product->umkm_id)
            ->limit(6) // Batasi jumlah produk terkait yang diambil
            ->get();

            $relatedProducts = DB::table('produk_umkm')
            ->select(
                'produk_umkm.id',
                'produk_umkm.nama_produk',
                'produk_umkm.harga',
                'produk_umkm.deskripsi',
                'produk_umkm.gambar_produk'
            )
            ->where('kategori_id', $product->kategori_id)
            ->where('id', '!=', $product->id) // Kecualikan produk yang sedang dilihat
            ->limit(6) // Batasi jumlah produk terkait yang diambil
            ->get();

        $data = [
            'title' => $product->nama_produk,
            'produk' => $product,
            'galeri' => $galeri,
            'umkm_produk' => $produkUmkm, // Produk terkait berdasarkan kategori
            'related_produk' => $relatedProducts, // Produk terkait berdasarkan kategori

        ];
        $views = [
            'views' => DB::raw('views + 1'),
        ];

        DB::table('produk_umkm')->where('id', $id)->update($views);
        return view('product_detail', $data);
    }

    

  
}
