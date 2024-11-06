@extends('layouts_admin.app')

@section('content')
    <div class="row">
        <!-- [ Gallery-Grid ] start -->
        <div class="col-sm-12">
            <!-- [ Image-Grid ] start -->
            <div class="card">

                <div class="card-header">
                    <div class="row">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Tampilkan pesan error -->
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="col-2">
                            <a href="{{ url('/admin/produk') }}" class="btn btn-primary" data-bs-toggle="tooltip"
                                data-bs-original-title="btn btn-primary">Kembali</a>
                        </div>
                        <div class="col-4">
                            <img src="{{ asset($produk->gambar_produk) }}" class="img-radius wid-80 m-auto"
                                alt="User Profile Image">&nbsp;
                            <h5>Galeri {{ $produk->nama_produk }}</h5>
                        </div>
                        <div class="col-6">
                            <label>Tambah Galeri Produk</label>
                            <form action="{{ url('/admin/produk-insert') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="hidden" name="id_produk_galeri" id="id_produk_galeri"
                                        value="{{ $produk->id }}">
                                    <input type="file" class="form-control" id="img_galeri" name="img_galeri">

                                </div>
                                <button type="submit" class="btn btn-primary float-end">Simpan</button>
                            </form>
                        </div>

                    </div>
                </div>
                <style>
                    .img-fixed {
                        width: 200px;
                        /* Sesuaikan lebar sesuai kebutuhan Anda */
                        height: 200px;
                        /* Sesuaikan tinggi sesuai kebutuhan Anda */
                        object-fit: cover;
                        /* Mengisi area gambar tanpa distorsi */
                    }
                </style>
                <div class="card-body">
                    <div class="row">
                        @foreach ($galeri as $item)
                            <div class="col-lg-2 col-sm-6">
                                <div class="thumbnail mb-4">
                                    <div class="thumb">
                                        <a href="{{ asset($item->gambar_produk) }}" data-lightbox="1" data-title="">
                                            <img src="{{ asset($item->gambar_produk) }}" alt=""
                                                class="img-fixed img-thumbnail">
                                        </a>
                                    </div>
                                    <button type="button" data-id="{{ $item->id }}" onclick="delGaleri(this)"
                                        class="btn btn-danger btn-sm mt-2">Hapus</button>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>

        </div>
        <!-- [ Gallery-Grid ] end -->
    </div>
@endsection

@section('style')
@endsection

@push('scripts')
    <!--lightbox Js -->
    <script src="{{ asset('assets_admin/plugins/lightbox2-master/js/lightbox.min.js') }}"></script>

    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true
        })
    </script>
    <script>
        $(document).ready(function() {});

        function delGaleri(elem) {
            var id = $(elem).data("id");


            var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Ambil token CSRF

            var title = "Hapus ..?"


            swal({
                    title: title,
                    text: '',
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: BASE_URL + '/admin/produk-delete-galeri/' + id,
                            type: "DELETE",
                            data: {
                                _token: csrfToken, // Sertakan token CSRF di sini
                            },
                            success: function(data) {


                                if (data.success == false) {
                                    // Loop through each error message and display it using the toast
                                    swal('Gagal!', data.message, 'error');
                                } else if (data.success == true) {
                                    swal('Berhasil!', data.message, 'success');
                                     // Reload halaman setelah konfirmasi swal sukses
                                     location.reload();
                                }
                            },
                            error: function() {
                                swal('Gagal!', 'Terjadi Kesalahan', 'error');
                            }
                        });
                    } else {
                        swal("Anda telah membatalkan hapus data", {
                            icon: "error",
                        });
                    }
                });


        }
    </script>
@endpush
