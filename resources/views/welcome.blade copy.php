@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="row align-items-center mb-4 pb-1">
                <div class="col-12">
                    <div class="product_header">
                        <div class="product_header_left">
                            <div class="custom_select">
                                <select class="form-control form-control-sm" id="sortProducts">
                                    <option value="order">Urutkan berdasarkan</option>
                                    <option value="popularity">Populer</option>
                                    <option value="date">Terbaru</option>
                                    <option value="price">Harga: terendah ke tinggi</option>
                                    <option value="price-desc">Harga: tinggi ke terendah</option>
                                </select>
                            </div>
                        </div>
                        {{-- <div class="product_header_right">
                            <div class="products_view">
                                <a href="javascript:void(0);" class="shorting_icon grid active"><i
                                        class="ti-view-grid"></i></a>
                                <a href="javascript:void(0);" class="shorting_icon list"><i
                                        class="ti-layout-list-thumb"></i></a>
                            </div>
                            <div class="custom_select">
                                <select class="form-control form-control-sm">
                                    <option value="">Showing</option>
                                    <option value="9">9</option>
                                    <option value="12">12</option>
                                    <option value="18">18</option>
                                </select>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="row shop_container" id="produk-item-data">

            </div>
            <div class="row">
                <div class="col-md-12 items-center">
                    <a id="load-more" class="btn btn-primary btn-sm float-lg-right" style="display: none;"
                        href="javascript:void(0);">Tampilkan
                        Lebih
                        Banyak >></a>
                </div>
            </div>
        </div>
    </div>
    <style>
        .avatar-container {
            display: flex;
            /* Menggunakan flexbox untuk tata letak */
            align-items: center;
            /* Menyelaraskan item secara vertikal di tengah */
        }

        .avatar {
            width: 30px;
            /* Atur lebar avatar */
            height: 30px;
            /* Atur tinggi avatar */
            border-radius: 50%;
            /* Membuat gambar berbentuk lingkaran */
            overflow: hidden;
            /* Menyembunyikan bagian gambar yang keluar */
            margin-right: 10px;
            /* Memberikan jarak antara avatar dan nama */
        }

        .avatar img {
            width: 100%;
            /* Memastikan gambar memenuhi elemen avatar */
            height: auto;
            /* Mempertahankan rasio aspek gambar */
        }

        .name {
            font-size: 10px;
            /* Atur ukuran font untuk nama */
            /* font-weight: bold; */
            /* Membuat nama menjadi tebal */
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

        function getProduct(page) {
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
                            var produkHTML = `
                    <div class="col-lg-3 col-md-4 col-6 grid_item">
                        <div class="product">
                            <div class="product_img">
                                <a href="shop-product-detail.html">
                                    <img height="200px" src="${item.gambar_produk}">
                                </a>
                                <div class="product_action_box">
                                    <ul class="list_none pr_action_btn">
                                        <li class="add-to-cart"><a href="{{ url('/get-product/${item.id}') }}"><i class="icon-basket-loaded"></i> Add To Cart</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product_info">
                                <h6 class="product_title"><a href="{{url('/get-product/${item.id}')}}">${item.nama_produk}</a></h6>
                                <div class="product_price">
                                    <span class="price">Rp. ${item.harga}</span>
                                </div>
                                <div class="rating_wrap">
                                    <div class="avatar-container">
                                        <div class="avatar">
                                            <img src="${item.gambar_produk}" alt="Avatar UMKM"/>
                                        </div>
                                        <div class="name">${item.nama_umkm}</div>
                                    </div>
                                </div>
                                <div class="pr_desc">
                                    <p>${item.deskripsi}</p>
                                </div>
                                <div class="list_product_action_box">
                                    <ul class="list_none pr_action_btn">
                                        <li class="add-to-cart"><a href="#"><i class="icon-basket-loaded"></i> Lihat produk ini</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>`;
                            $('#produk-item-data').append(produkHTML);
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
