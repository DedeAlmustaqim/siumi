<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class ProdukController extends Controller
{
    public function index()
    {
        $umkm = DB::table('umkm')->get();
        $kategori = DB::table('kategori')->get();
        $data = [
            'title' => 'Produk',
            'umkm' => $umkm,
            'kategori' => $kategori,

        ];
        return view('admin/produk', $data);
    }

    public function getDatatables()
    {
        $data = DB::table('produk_umkm')
            ->select(
                'produk_umkm.id',
                'produk_umkm.nama_produk',
                'produk_umkm.deskripsi',
                'produk_umkm.harga',
                'produk_umkm.stok',
                'produk_umkm.umkm_id',
                'produk_umkm.created_at',
                'produk_umkm.updated_at',
                'produk_umkm.gambar_produk',
                'produk_umkm.status_produk',
                'produk_umkm.views',
                'umkm.nama_umkm',
                'kategori.nama_kategori',

            )
            ->join('umkm', 'produk_umkm.umkm_id', '=', 'umkm.id')
            ->join('kategori', 'produk_umkm.kategori_id', '=', 'kategori.id')
            // ->where('table.id', $where)
            ->orderBy('produk_umkm.id', 'ASC')
            //Gunakan kondisi sesuai role login
            //->when(auth()->user()->role === 'role', function ($query) {
            //return $query->where('table.role', session('role'));
            //})
            ->get();
        return DataTables::of($data)
            ->rawColumns(['action'])
            ->make(true);
    }

    public function insert(Request $request)
    {

        // Cek apakah request ID sudah ada di cache
        $requestId = $request->header('X-Request-ID');
        if (Cache::has($requestId)) {
            return response()->json(['success' => false, 'message' => 'Permintaan duplikat.']);
        }

        // Hapus titik dari input harga sebelum validasi
        $request->merge([
            'harga' => str_replace('.', '', $request->input('harga'))
        ]);

        $validator = Validator::make(
            $request->all(),
            [
                'nama_produk' => 'required|string|max:255',
                'umkm_id' => 'required|string|max:255',
                'kategori_id' => 'required|string|min:1|max:12',
                'harga' => 'required|numeric|max:9999999999', // Harga harus berupa angka setelah titik dihilangkan
                'stok' => 'required|integer|min:1|max:500',
                'status_produk' => 'required|string|max:255',
                'deskripsi_produk' => 'required|string|max:1000',
                'img_produk' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ],
            [
                'nama_produk.required' => 'Nama produk wajib diisi.',
                'nama_produk.string' => 'Nama produk harus berupa teks.',
                'nama_produk.max' => 'Nama produk tidak boleh lebih dari 255 karakter.',

                'umkm_id.required' => 'ID UMKM wajib diisi.',
                'umkm_id.string' => 'ID UMKM harus berupa teks.',
                'umkm_id.max' => 'ID UMKM tidak boleh lebih dari 255 karakter.',

                'kategori_id.required' => 'Kategori produk wajib diisi.',
                'kategori_id.string' => 'Kategori harus berupa teks.',
                'kategori_id.min' => 'Kategori harus memiliki minimal 11 karakter.',
                'kategori_id.max' => 'Kategori tidak boleh lebih dari 12 karakter.',

                'harga.required' => 'Harga wajib diisi.',
                'harga.numeric' => 'Harga harus berupa angka.',
                'harga.max' => 'Harga tidak boleh lebih dari 10 digit angka.',

                'stok.required' => 'Stok produk wajib diisi.',
                'stok.integer' => 'Stok harus berupa angka.',
                'stok.min' => 'Stok minimal adalah 1.',
                'stok.max' => 'Stok tidak boleh lebih dari 500 unit.',

                'status_produk.required' => 'Status produk wajib diisi.',
                'status_produk.string' => 'Status produk harus berupa teks.',
                'status_produk.max' => 'Status produk tidak boleh lebih dari 255 karakter.',

                'deskripsi_produk.required' => 'Deskripsi produk wajib diisi.',
                'deskripsi_produk.string' => 'Deskripsi produk harus berupa teks.',
                'deskripsi_produk.max' => 'Deskripsi produk tidak boleh lebih dari 1000 karakter.',

                'img_produk.required' => 'Gambar produk wajib diunggah.',
                'img_produk.image' => 'File yang diunggah harus berupa gambar.',
                'img_produk.mimes' => 'Gambar harus memiliki format jpeg, png, atau jpg.',
                'img_produk.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all()
            ]);
        }

        $validatedData = [
            'nama_produk' => $request->input('nama_produk'),
            'umkm_id' => $request->input('umkm_id'),
            'kategori_id' => $request->input('kategori_id'),
            'harga' => $request->input('harga'), // Harga tanpa titik
            'stok' => $request->input('stok'),
            'status_produk' => $request->input('status_produk'),
            'deskripsi' => $request->input('deskripsi_produk'),
        ];

        // Proses upload gambar
        if ($request->hasFile('img_produk')) {
            $image = $request->file('img_produk');
            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets_admin/images/produk/'), $imageName);
            $validatedData['gambar_produk'] = 'assets_admin/images/produk/' . $imageName;
        }

        try {
            DB::table('produk_umkm')->insert($validatedData);
            return response()->json(['success' => true, 'message' => 'Data berhasil ditambahkan.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function galeri($id)
    {
        $produk = DB::table('produk_umkm')->where('id', $id)->first();
        $galeri = DB::table('galeri_produk')->where('produk_id', $id)->get();
        $data = [
            'title' => $produk->nama_produk,
            'produk' => $produk,
            'galeri' => $galeri,
        ];
        return view('admin/galeri', $data);
    }

    public function insertGaleri(Request $request)
    {
        // Validasi file
        $request->validate([
            'img_galeri' => 'required|file|mimes:jpg,jpeg,png|max:2048', // maksimal 2MB
            'id_produk_galeri' => 'required|integer', // Validasi untuk produk ID jika diperlukan
        ]);

        try {
            $validatedData = [
                'produk_id' => $request->input('id_produk_galeri')

            ];

            if ($request->hasFile('img_galeri')) {
                $image = $request->file('img_galeri');
                $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('produk_galeri/'), $imageName);
                $validatedData['gambar_produk'] = 'produk_galeri/' . $imageName;
            }

            // Update path logo di database untuk produk tertentu
            DB::table('galeri_produk')->insert($validatedData);

            return redirect()->back()->with('success', 'Data berhasil diperbarui.');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, kembalikan dengan pesan error
            return redirect()->back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroyGaleri($id)
    {
        $product = DB::table('galeri_produk')->find($id);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Produk tidak ditemukan'], 404); // 404: Not Found
        }

        try {
            DB::table('galeri_produk')->where('id', $id)->delete();

            return response()->json(['success' => true, 'message' => 'Produk berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus produk'], 500); // 500: Internal Server Error
        }
    }


    public function destroy($id)
    {
        $product = DB::table('produk_umkm')->find($id);
        $product_galeri = DB::table('galeri_produk')->where('produk_id', $id)->get();

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Produk tidak ditemukan'], 404); // 404: Not Found
        }

        try {
            // Loop untuk menghapus setiap gambar di galeri
            foreach ($product_galeri as $galeri) {
                if ($galeri->gambar_produk && file_exists(public_path($galeri->gambar_produk))) {
                    unlink(public_path($galeri->gambar_produk));
                }
            }

            // Hapus data produk dan galeri dari database
            DB::table('produk_umkm')->where('id', $id)->delete();
            DB::table('galeri_produk')->where('produk_id', $id)->delete();

            return response()->json(['success' => true, 'message' => 'Produk berhasil dihapus'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus produk'], 500); // 500: Internal Server Error
        }
    }

    public function getData($id): JsonResponse
    {
        $data = DB::table('produk_umkm')->where('id', $id)->first();

        if ($data) {
            return response()->json($data, Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Not found'], Response::HTTP_NOT_FOUND);
        }
    }

    public function update(Request $request)
    {
        // Hapus titik dari input harga sebelum validasi
        $request->merge([
            'harga_edit' => str_replace('.', '', $request->input('harga_edit'))
        ]);

        $validator = Validator::make(
            $request->all(),
            [
                'nama_produk_edit' => 'required|string|max:255',
                'umkm_id_edit' => 'required|string|max:255',
                'kategori_id_edit' => 'required|string|min:1|max:12',
                'harga_edit' => 'required|numeric|max:9999999999', // Harga harus berupa angka setelah titik dihilangkan
                'stok_edit' => 'required|integer|min:1|max:500',
                'status_produk_edit' => 'required|string|max:255',
                'deskripsi_produk_edit' => 'required|string|max:1000',
                'img_produk_edit' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Gambar opsional
            ],
            [
                // Pesan validasi khusus
                'nama_produk_edit.required' => 'Nama produk wajib diisi.',
                'nama_produk_edit.string' => 'Nama produk harus berupa teks.',
                'nama_produk_edit.max' => 'Nama produk tidak boleh lebih dari 255 karakter.',

                'umkm_id_edit.required' => 'ID UMKM wajib diisi.',
                'umkm_id_edit.string' => 'ID UMKM harus berupa teks.',
                'umkm_id_edit.max' => 'ID UMKM tidak boleh lebih dari 255 karakter.',

                'kategori_id_edit.required' => 'Kategori produk wajib diisi.',
                'kategori_id_edit.string' => 'Kategori harus berupa teks.',
                'kategori_id_edit.min' => 'Kategori harus memiliki minimal 11 karakter.',
                'kategori_id_edit.max' => 'Kategori tidak boleh lebih dari 12 karakter.',

                'harga_edit.required' => 'Harga wajib diisi.',
                'harga_edit.numeric' => 'Harga harus berupa angka.',
                'harga_edit.max' => 'Harga tidak boleh lebih dari 10 digit angka.',

                'stok_edit.required' => 'Stok produk wajib diisi.',
                'stok_edit.integer' => 'Stok harus berupa angka.',
                'stok_edit.min' => 'Stok minimal adalah 1.',
                'stok_edit.max' => 'Stok tidak boleh lebih dari 500 unit.',

                'status_produk_edit.required' => 'Status produk wajib diisi.',
                'status_produk_edit.string' => 'Status produk harus berupa teks.',
                'status_produk_edit.max' => 'Status produk tidak boleh lebih dari 255 karakter.',

                'deskripsi_produk_edit.required' => 'Deskripsi produk wajib diisi.',
                'deskripsi_produk_edit.string' => 'Deskripsi produk harus berupa teks.',
                'deskripsi_produk_edit.max' => 'Deskripsi produk tidak boleh lebih dari 1000 karakter.',

                'img_produk_edit.image' => 'File yang diunggah harus berupa gambar.',
                'img_produk_edit.mimes' => 'Gambar harus memiliki format jpeg, png, atau jpg.',
                'img_produk_edit.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all()
            ]);
        }

        $id = $request->input('id_produk');
        $validatedData = [
            'nama_produk' => $request->input('nama_produk_edit'),
            'umkm_id' => $request->input('umkm_id_edit'),
            'kategori_id' => $request->input('kategori_id_edit'),
            'harga' => $request->input('harga_edit'), // Harga tanpa titik
            'stok' => $request->input('stok_edit'),
            'status_produk' => $request->input('status_produk_edit'),
            'deskripsi' => $request->input('deskripsi_produk_edit'),
        ];

        try {
            // Jika gambar baru diunggah, hapus gambar lama dan unggah gambar baru
            if ($request->hasFile('img_produk_edit')) {
                $product = DB::table('produk_umkm')->where('id', $id)->first();

                // Hapus gambar lama jika ada
                if ($product && $product->gambar_produk && file_exists(public_path($product->gambar_produk))) {
                    unlink(public_path($product->gambar_produk));
                }

                // Unggah gambar baru
                $image = $request->file('img_produk_edit');
                $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets_admin/images/produk/'), $imageName);
                $validatedData['gambar_produk'] = 'assets_admin/images/produk/' . $imageName;
            }

            DB::table('produk_umkm')->where('id', $id)->update($validatedData);
            return response()->json(['success' => true, 'message' => 'Data berhasil diperbarui.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
