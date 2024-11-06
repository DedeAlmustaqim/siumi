<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Service\WaController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    public function index($id)
    {
        $produk = DB::table('produk_umkm')->where('id', $id)->first();
        $data = [
            'title' => $produk->nama_produk,
            'produk' => $produk
        ];
        return view('checkout', $data);
    }

    public function checkoutSuccess()
    {
        $data = [
            'title' => 'Berhasil'
        ];
        return view('checkout_success', $data);
    }

    public function checkout(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama' => 'required|max:255',
                'no_hp_co' => 'required|numeric|digits_between:10,12',
                'catatan' => 'max:500',
                'alamat' => 'required|max:500',
                'kabupaten' => 'required|max:100',
                'kecamatan' => 'required|max:100',
                'kelurahan' => 'required|max:100',
                'kuantitas' => 'required|integer|min:1',


            ],
            [
                'nama.required' => 'Nama wajib diisi.',
                'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',
                'no_hp_co.required' => 'Nomor HP wajib diisi.',
                'no_hp_co.numeric' => 'Nomor HP harus berupa angka.',
                'no_hp_co.digits_between' => 'Nomor HP harus antara 10 hingga 12 digit.',
                'alamat.required' => 'Alamat wajib diisi.',
                'alamat.max' => 'Alamat tidak boleh lebih dari 500 karakter.',
                'kabupaten.required' => 'Kabupaten wajib diisi.',
                'kabupaten.max' => 'Kabupaten tidak boleh lebih dari 100 karakter.',
                'kecamatan.required' => 'Kecamatan wajib diisi.',
                'kecamatan.max' => 'Kecamatan tidak boleh lebih dari 100 karakter.',
                'kelurahan.required' => 'Kelurahan wajib diisi.',
                'kelurahan.max' => 'Kelurahan tidak boleh lebih dari 100 karakter.',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Konversi 'total' dari format Rp ke format decimal
        $total = $request->input('harga') * $request->input('kuantitas');

        $validatedData = array_merge($validator->validated(), [
            'total' => $total,
            'produk_id' => $request->input('id_produk_co')
        ]);

        try {
            DB::table('checkout')->insert($validatedData);

            $produk = DB::table('produk_umkm')->where('id', $request->input('id_produk_co'))->first();
            $umkm = DB::table('umkm')->where('id', $produk->umkm_id)->first();
            $wa = new WaController();

            $msg = 'Pesanan masuk dengan rincian sbb \n2
Nama Produk : ' . $produk->nama_produk . '
Kuantitas : ' . $validatedData['kuantitas'] . '
Total Pembayaran : Rp. ' . number_format($validatedData['total']) . '
Nama Pemesan : ' . $validatedData['nama'] . '
No Hp : ' . $validatedData['no_hp_co'] . '
catatan : ' . $validatedData['catatan'] . '
Alamat : ' . $validatedData['alamat'] . '
Kabupaten : ' . $validatedData['kabupaten'] . '
Kecamatan : ' . $validatedData['kecamatan'] . '
Kelurahan/Desa : ' . $validatedData['kelurahan'] . '
Tanggal Pesanan : ' . Carbon::now() . '

';

            $wa->sendMessage($umkm->no_telp, $msg);

            return redirect()->route('checkout_success')->with('success', 'Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
