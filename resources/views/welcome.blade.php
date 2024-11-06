@extends('layouts.app')

@section('content')
    <div class="row">
        <!-- left-side --->
        <div class="col-sm-3 col-md-3">
            <div class="weight">
                <div class="title">
                    <h2>Kategori <i class="material-icons">&#xE313;</i></h2>
                </div>
                <div class="panel-group" id="accordion">
                    @foreach ($category as $item)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" 
                                        href="{{url('/kategori/'.$item->id)}}">
                                        {{ $item->nama_kategori }}
                                        <i class="indicator fa fa-arrow-right  pull-right"></i>
                                        <br>
                                        <small>{{ $item->deskripsi }}</small>
                                    </a>
                                </h4>
                            </div>

                        </div>
                    @endforeach
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle" 
                                    href="{{url('/all-kategori')}}">
                                    Semua Kategori
                                    <i class="indicator fa fa-arrow-right  pull-right"></i>
                                    
                                </a>
                            </h4>
                        </div>

                    </div>

                </div>
            </div>

        </div>
        <!-- /left-side --->
        <!-- right-side --->
        <div class="col-sm-9 col-md-9">
            {{-- <div class="grid-banner"><img src="assets/images/10_grid_view_box_layout/banner_image.jpg" alt="2" />
            </div> --}}
            <div class="grid-spr">
                <div class="row">
                    {{-- <div class="col-lg-5"> <a href="#" class="grid-view-icon"><i class="fa fa-th-large"
                                aria-hidden="true"></i></a> <a href="#" class="list-view-icon"><i class="fa fa-list"
                                aria-hidden="true"></i></a>
                        <strong>Showing 1-16 of 80 items</strong>
                    </div> --}}
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
        <!-- /right-side --->
    </div>
    <style>
        .img-circle {
            border-radius: 50%;
            /* Membuat gambar berbentuk lingkaran */
            width: 30px;
            /* Atur ukuran sesuai dengan kebutuhan */
            height: 30px;
            /* Pastikan tinggi dan lebar sama agar lingkaran sempurna */
        }

        .mt-5 {
            margin-top: 5px;
            /* Berikan margin atas 5px */
        }
    </style>
@endsection

@section('style')
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            let currentPage = 1;
            getProduct(currentPage)
            $('#load-more').click(function() {
                currentPage++;
                getProduct(currentPage);
            });

            // Event listener untuk perubahan pada dropdown sort
            $('#sortProducts').on('change', function() {
                currentPage = 1; // Reset halaman ke 1 saat sort berubah
                $('#produk-item-data').empty(); // Hapus semua produk yang ada
                getProduct(currentPage); // Panggil ulang untuk produk baru
            });



        })

        function formatRupiah(angka) {
            return "Rp " + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }


        function getProduct(page) {
            // $('#no-more-assets').hide();
            $.ajax({
                url: BASE_URL + '/get-products?page=' + page, // URL dengan parameter halaman
                method: 'GET', // Tambahkan method di tempat yang tepat
                data: {
                    sort: $('#sortProducts').val() // Mengambil nilai dari dropdown perusahaan
                },
                success: function(response) {
                    const data = response.data;

                    if (data.length > 0) {
                        data.forEach(function(item) {
                            // Buat HTML untuk setiap produk
                           


                            var html = `<a href="${BASE_URL}/get-product/${item.id}"><div class="col-sm-6 col-lg-4">
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
