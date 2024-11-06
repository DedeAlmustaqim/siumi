<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class KategoriController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Kategori'
        ];
        return view('admin/kategori', $data);
    }

    public function getDatatablesKategori()
    {
        $data = DB::table('kategori')

            ->orderBy('kategori.id', 'ASC')
            //Gunakan kondisi sesuai role login
            //->when(auth()->user()->role === 'role', function ($query) {
            //return $query->where('table.role', session('role'));
            //})
            ->get();
        return DataTables::of($data)
            ->rawColumns(['action'])
            ->make(true);
    }

    public function insertKategori(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama_kategori' => 'required|max:255',
                'deskripsi_kategori' => 'required|max:500',
            ],
            [
                'nama_kategori.required' => 'Nama Kategori wajib diisi.',
                'nama_kategori.max' => 'Nama Kategori tidak boleh dari 255 karakter.',
                'deskripsi_kategori.required' => 'Deskripsi wajib diisi.',
                'deskripsi_kategori.max' => 'Deskripsi tidak boleh dari 500 karakter.',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all() // Ambil semua error sebagai array
            ]); // 422: Unprocessable Entity
        }

        $validatedData = [
            'nama_kategori' => $request->input('nama_kategori'),
            'deskripsi' => $request->input('deskripsi_kategori'),
        ];

        try {
            DB::table('kategori')->insert($validatedData);
            return response()->json(['success' => true, 'message' => 'Data  berhasil ditambahkan.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e]);
        }
    }

    public function updateKategori(Request $request)
    {
        $id = $request->input('id_kategori_edit');
        $validator = Validator::make(
            $request->all(),
            [
                'nama_kategori_edit' => 'required|max:255',
                'deskripsi_kategori_edit' => 'required|max:500',
            ],
            [
                'nama_kategori_edit.required' => 'Nama Kategori wajib diisi.',
                'nama_kategori_edit.max' => 'Nama Kategori tidak boleh dari 255 karakter.',
                'deskripsi_kategori_edit.required' => 'Deskripsi wajib diisi.',
                'deskripsi_kategori_edit.max' => 'Deskripsi tidak boleh dari 500 karakter.',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all() // Ambil semua error sebagai array
            ]); // 422: Unprocessable Entity
        }

        $validatedData = [
            'nama_kategori' => $request->input('nama_kategori_edit'),
            'deskripsi' => $request->input('deskripsi_kategori_edit'),
        ];

        try {
            DB::table('kategori')->where('id',$id)->update($validatedData);
            return response()->json(['success' => true, 'message' => 'Data  berhasil diupdate.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e]);
        }
    }

    public function destroy($id)
    {
        // Ambil data dari tabel data_wna
        $data = DB::table('kategori')->find($id);

        // Jika data tidak ditemukan, kembalikan respons 404
        if (!$data) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan']); // 404: Not Found
        }

        $produk = DB::table('produk_umkm')->where('kategori_id', $id)->first();

        // Jika produk ditemukan, tidak dapat menghapus UMKM
        if ($produk) {
            return response()->json(['success' => false, 'message' => 'Tidak bisa hapus Kategori karena ada Produk.']); // 409: Conflict
        }

        try {
            // Mencari produk berdasarkan umkm_id


           

            // Hapus data dari database
            DB::table('kategori')->where('id', $id)->delete();

            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus data: ' . $e->getMessage()]); // 500: Internal Server Error
        }
    }
}
