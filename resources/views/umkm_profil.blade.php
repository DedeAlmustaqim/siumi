@extends('layouts.app')
<style>
    .custom-client-box {
        display: flex;
        align-items: center;
        width: 100%;
        padding: 15px;
        box-sizing: border-box;
        background-color: #f9f9f9;
        /* Warna latar belakang opsional */
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .custom-client-box-img {
        margin-right: 20px;
        /* Jarak antara gambar dan konten */
    }

    .custom-client-box-content {
        flex-grow: 1;
    }

    .custom-name-title {
        font-size: 1.5em;
        /* Ukuran font lebih besar untuk Nama UMKM */
        font-weight: bold;
        margin: 0;
    }

    .custom-description {
        text-align: justify;
        /* Justify untuk deskripsi */
        margin-top: 5px;
    }

    .custom-info-table {
        width: 100%;
        margin-top: 15px;
        border-collapse: collapse;
    }

    .custom-info-table td {
        padding: 5px 10px;
        font-size: 1em;
        color: #333;
        border: 1px;
    }

    .custom-info-table td:first-child {
        font-weight: bold;
        width: 150px;
        /* Atur lebar kolom pertama agar lebih konsisten */
    }
</style>
@section('content')
    <input type="hidden" name="" id="id_umkm_show" value="{{ $umkm->id }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- custom-client-box -->
                <div class="custom-client-box">
                    <div class="custom-client-box-img">
                        <img src="{{ url('/') }}/{{ $umkm->img_umkm }}" width="150px" alt="client img">
                    </div>
                    <div class="custom-client-box-content">
                        <p class="custom-name-title">{{ $umkm->nama_umkm }}</p>
                        <p class="custom-description">{{ $umkm->tentang }}.</p>

                        <!-- Informasi tambahan -->
                        <table class="custom-info-table">
                            <tr>
                                <td>Nama Pemilik</td>
                                <td>: {{ $umkm->pemilik }}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>: {{ $umkm->alamat }}</td>
                            </tr>
                            
                            {{-- <tr>
                            <td>Titik Lokasi</td>
                            <td>: {{$umkm->lokasi}}</td>
                        </tr> --}}
                        </table>
                    </div>
                </div>
                <!-- /custom-client-box -->
            </div>
        </div>
    </div>

    <!-- .shopping-cart -->
    <div class="container">
        <div class="col-sm-12 col-md-12">

            <div class="grid-spr">

                <div class="row">
                    <div class="col-lg-5">
                        <div class="title">
                            <h2>Produk UMKM ini </span></h2>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <span class="mt-1">Urutkan berdasarkan</span>

                    </div>
                    <div class="col-lg-5">
                        <div class="form-group">
                            <label for=""></label>
                            <select class="form-control" name="" id="sortProducts">
                                <option value="order">Pilih</option>
                                <option value="popularity">Populer</option>
                                <option value="date">Terbaru</option>
                                <option value="price">Harga : terendah - tertinggi</option>
                                <option value="price-desc">Harga : tertinggi - terendah</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div id="produk-item-data"></div>

                <div class="col-lg-12 text-center">

                    <a href="javascript:void(0);" id="load-more" class="load-more">Tampilkan Lebih
                        Banyak</a>

                    <a href="javascript:void(0);" id="no-more-assets" class="load-more">tidak ada produk lagi</a>
                </div>


            </div>

        </div>



    </div>
    <!-- /.shopping-cart -->
@endsection

@section('style')
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            var id = $('#id_umkm_show').val()
            let currentPage = 1;
            get(currentPage, id)
            $('#load-more').click(function() {
                currentPage++;
                get(currentPage, id);
            });


            // Event listener untuk perubahan pada dropdown sort
            $('#sortProducts').on('change', function() {
                currentPage = 1; // Reset halaman ke 1 saat sort berubah
                $('#produk-item-data').empty(); // Hapus semua produk yang ada
                get(currentPage, id); // Panggil ulang untuk produk baru
            });


        })




        function get(page, id) {
            // $('#no-more-assets').hide();
            $.ajax({
                url: BASE_URL + '/umkm-produk-data/' + id + '?page=' + page, // URL dengan parameter halaman
                method: 'GET', // Tambahkan method di tempat yang tepat
                data: {
                    sort: $('#sortProducts').val() // Mengambil nilai dari dropdown perusahaan
                },
                success: function(response) {
                    const data = response.data;

                    if (data.length > 0) {
                        data.forEach(function(item) {
                            // Buat HTML untuk setiap produk



                            var html = `<a href="${BASE_URL}/get-product/${item.id}"><div class="col-sm-3 col-lg-3">
										<!-- .pro-text -->
										<div class="pro-text">
											<!-- .pro-img -->
											<div class="pro-img">
												<img src="${BASE_URL}/${item.gambar_produk	}" height="300px" alt="2">
												<a href="${BASE_URL}/get-product/${item.id}" class="favorite_border"><i class="material-icons">favorite_border</i></a>
											</div>
											<!-- /.pro-img -->
											<div class="pro-text-outer">
												              <img class="img-circle mb-5" height="30px" src="${BASE_URL}/${item.img_umkm}">&nbsp;
                        <a href="${BASE_URL}/umkm-profil/${item.umkm_id}"><small class="mt-5 "> ${item.nama_umkm}</small></a>
                        <br>
                        <br>
												<a href="${BASE_URL}/get-product/${item.id}">
													<h3 class="text-danger">${item.nama_produk}</h3>
												</a>
												<div class="wk-price">${formatRupiah(item.harga)}
													
                                                    ${item.status_produk === 'tersedia' ? 
                                                    '<div class="in-stock"><i class="material-icons">&#xE5CA;</i> tersedia</div>' : 
                                                    '<div class="in-stock"><i class="material-icons " style="color: red;">&#xE14C;</i> tidak tersedia</div>'}

												</div>

											</div>
										</div>
										<!-- /.pro-text -->
									</div></a>`

                            $('#produk-item-data').append(html);
                        });

                        // Tampilkan tombol "Load More" jika ada lebih banyak data
                        if (response.current_page < response.last_page) {
                            $('#load-more').show();
                            $('#no-more-assets').hide();
                        } else {
                            $('#load-more').hide();
                            $('#no-more-assets').show(); // Tampilkan pesan "Tidak Ada Produk Lagi"
                        }
                    } else {
                        $('#load-more').hide(); // Sembunyikan tombol jika tidak ada data lagi
                        $('#no-more-assets').show(); // Tampilkan pesan "Tidak Ada Produk Lagi"
                    }
                },
                error: function() {
                    $('#load-more-container').append('<p>Error retrieving products</p>');
                }
            });
        }
    </script>
@endpush
