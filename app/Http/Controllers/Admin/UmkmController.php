<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;

class UmkmController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Kelola UMKM'
        ];
        return view('admin/umkm', $data);
    }

    public function getUmkm()
    {
        $data = DB::table('umkm')
            // ->select(
            //     'umkm.id',
            // )
            //->join('table_2', 'table.id_kec', '=', 'table_2.id')
            // ->where('table.id', $where)
            ->orderBy('umkm.id', 'ASC')
            //Gunakan kondisi sesuai role login
            //->when(auth()->user()->role === 'role', function ($query) {
            //return $query->where('table.role', session('role'));
            //})
            ->get();
        return DataTables::of($data)
            ->rawColumns(['action'])
            ->make(true);
    }

    public function insertUmkm(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama_umkm' => 'required|string|max:255',
                'pemilik' => 'required|string|max:255',
                'no_telp' => 'required|string|min:11|max:12',
                'no_ijin' => 'required|string|max:50',
                'alamat' => 'required|string|max:500',
                'tentang' => 'required|string|max:500',
                'lat' => 'required|numeric|between:-90,90', // Validasi latitude
                'long' => 'required|numeric|between:-180,180', // Validasi longitude
                'img_umkm' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ],
            [
                'nama_umkm.required' => 'Nama UMKM wajib diisi.',
                'nama_umkm.string' => 'Nama UMKM harus berupa teks.',
                'nama_umkm.max' => 'Nama UMKM tidak boleh lebih dari 255 karakter.',

                'pemilik.required' => 'Nama pemilik wajib diisi.',
                'pemilik.string' => 'Nama pemilik harus berupa teks.',
                'pemilik.max' => 'Nama pemilik tidak boleh lebih dari 255 karakter.',

                'no_telp.required' => 'Nomor telepon wajib diisi.',
                'no_telp.string' => 'Nomor telepon harus berupa teks.',
                'no_telp.min' => 'Nomor telepon harus terdiri dari minimal 11 karakter.',
                'no_telp.max' => 'Nomor telepon tidak boleh lebih dari 12 karakter.',

                'no_ijin.required' => 'Nomor izin wajib diisi.',
                'no_ijin.string' => 'Nomor izin harus berupa teks.',
                'no_ijin.max' => 'Nomor izin tidak boleh lebih dari 50 karakter.',

                'alamat.required' => 'Alamat wajib diisi.',
                'alamat.string' => 'Alamat harus berupa teks.',
                'alamat.max' => 'Alamat tidak boleh lebih dari 500 karakter.',

                'tentang.required' => 'Deskripsi tentang UMKM wajib diisi.',
                'tentang.string' => 'Deskripsi tentang UMKM harus berupa teks.',
                'tentang.max' => 'Deskripsi tentang UMKM tidak boleh lebih dari 500 karakter.',

                'img_umkm.image' => 'File yang diunggah harus berupa gambar.',
                'img_umkm.mimes' => 'Gambar harus memiliki format jpeg, png, atau jpg.',
                'img_umkm.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',

                'lat.required' => 'Latitude wajib diisi.',
                'lat.numeric' => 'Latitude harus berupa angka.',
                'lat.between' => 'Latitude harus berada dalam rentang -90 hingga 90.',

                'long.required' => 'Longitude wajib diisi.',
                'long.numeric' => 'Longitude harus berupa angka.',
                'long.between' => 'Longitude harus berada dalam rentang -180 hingga 180.',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()->all() // Ambil semua error sebagai array
            ]);
        }

        $validatedData = [
            'nama_umkm' => $request->input('nama_umkm'),
            'pemilik' => $request->input('pemilik'),
            'no_telp' => $request->input('no_telp'),
            'no_ijin' => $request->input('no_ijin'),
            'alamat' => $request->input('alamat'),
            'tentang' => $request->input('tentang'),
            'lat' => $request->input('lat'),
            'long' => $request->input('long'),
        ];

        // Proses upload gambar (opsional)
        if ($request->hasFile('img_umkm')) {
            // Mendapatkan file gambar
            $image = $request->file('img_umkm');
            // Memberi nama baru pada file berdasarkan UUID dan nama asli file
            $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
            // Menyimpan file di direktori public/assets_admin/images/umkm/
            $image->move(public_path('assets_admin/images/umkm/'), $imageName);

            // Tambahkan nama file ke data yang akan disimpan ke database
            $validatedData['img_umkm'] = 'assets_admin/images/umkm/' . $imageName;
        } else {
            // Jika tidak ada gambar yang diupload, gunakan gambar default
            $validatedData['img_umkm'] = 'assets_admin/images/umkm/store-default.png';
        }

        try {
            DB::table('umkm')->insert($validatedData);
            return response()->json(['success' => true, 'message' => 'Data berhasil ditambahkan.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function updateUmkm(Request $request)
{
    $validator = Validator::make(
        $request->all(),
        [
            'nama_umkm_edit' => 'required|string|max:255',
            'pemilik_edit' => 'required|string|max:255',
            'no_telp_edit' => 'required|string|min:11|max:12',
            'no_ijin_edit' => 'required|string|max:50',
            'alamat_edit' => 'required|string|max:500',
            'tentang_edit' => 'required|string|max:500',
            'lat_edit' => 'required|numeric|between:-90,90',
            'long_edit' => 'required|numeric|between:-180,180',
            'img_umkm_edit' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ],
        [
            // Pesan error
        ]
    );

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'errors' => $validator->errors()->all()
        ]);
    }

    $id = $request->input('id_umkm_edit');
    $umkm = DB::table('umkm')->where('id', $id)->first();

    $validatedData = [
        'pemilik' => $request->input('pemilik_edit'),
        'nama_umkm' => $request->input('nama_umkm_edit'),
        'no_telp' => $request->input('no_telp_edit'),
        'no_ijin' => $request->input('no_ijin_edit'),
        'alamat' => $request->input('alamat_edit'),
        'tentang' => $request->input('tentang_edit'),
        'lat' => $request->input('lat_edit'),
        'long' => $request->input('long_edit'),
    ];

    if ($request->hasFile('img_umkm_edit')) {
        // Hapus gambar lama jika ada
        if ($umkm && $umkm->img_umkm) {
            $oldImagePath = public_path($umkm->img_umkm);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
        }

        // Upload gambar baru
        $image = $request->file('img_umkm_edit');
        $imageName = Str::uuid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('assets_admin/images/umkm/'), $imageName);

        // Tambahkan nama file ke data yang akan disimpan ke database
        $validatedData['img_umkm'] = 'assets_admin/images/umkm/' . $imageName;
    }

    try {
        DB::table('umkm')->where('id', $id)->update($validatedData);
        return response()->json(['success' => true, 'message' => 'Data berhasil diupdate.']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()]);
    }
}

    public function getUmkmbyId($id): JsonResponse
    {
        $data = DB::table('umkm')->where('id', $id)->first();

        if ($data) {
            return response()->json($data, Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Not found'], Response::HTTP_NOT_FOUND);
        }
    }

    public function destroy($id)
    {
        // Ambil data dari tabel data_wna
        $umkm = DB::table('umkm')->find($id);

        // Jika data tidak ditemukan, kembalikan respons 404
        if (!$umkm) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan']); // 404: Not Found
        }

        $produk = DB::table('produk_umkm')->where('umkm_id', $id)->first();

        // Jika produk ditemukan, tidak dapat menghapus UMKM
        if ($produk) {
            return response()->json(['success' => false, 'message' => 'Tidak bisa hapus UMKM karena ada Produk.']); // 409: Conflict
        }

        try {
            // Mencari produk berdasarkan umkm_id


            // Cek apakah file gambar ada dan hapus dari direktori
            if ($umkm->img_umkm && file_exists(public_path($umkm->img_umkm))) {
                unlink(public_path($umkm->img_umkm));
            }

            // Hapus data dari database
            DB::table('umkm')->where('id', $id)->delete();

            return response()->json(['success' => true, 'message' => 'Data berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Gagal menghapus data: ' . $e->getMessage()]); // 500: Internal Server Error
        }
    }
}
