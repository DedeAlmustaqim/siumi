@extends('layouts.app')

@section('content')
    <br>
    <section class="grid-shop ">
        <!-- .grid-shop -->
        <style>
            .image-cover {
                width: 100%;
                /* Mengatur lebar kontainer */
                height: 400px;
                /* Tinggi kontainer bisa disesuaikan sesuai kebutuhan */
                overflow: hidden;
                /* Mencegah gambar keluar dari area kontainer */
                position: relative;
            }

            .image-cover img {
                width: 100%;
                /* Lebar gambar mengikuti lebar kontainer */
                height: 100%;
                /* Tinggi gambar mengikuti tinggi kontainer */
                object-fit: cover;
                /* Mengatur gambar agar tampil sebagai cover */
                object-position: center;
                /* Memusatkan gambar di tengah */
            }
        </style>
        <!-- .shop-deails-bg -->

        <div class="shop-deails-bg3">
            <div class="container">
                <div class="row">
                    <div class="col-sm-5 col-md-5">
                        <!-- product gallery -->
                        <div class="connected-carousels">
                            <div class="stage">
                                <div class="carousel carousel-stage" data-jcarousel="true">
                                    <ul style="left: 0px; top: 0px;">
                                        <li><img class="zoom_01" width="100%" height="500px" alt=""
                                                src="{{ url('/') }}/{{ $produk->gambar_produk }}"
                                                data-zoom-image="{{ url('/') }}/{{ $produk->gambar_produk }}"
                                                alt="qoute-icon"> </li>
                                        @foreach ($galeri as $item)
                                            <li><img class="zoom_01" width="100%" height="500px" alt=""
                                                    src="{{ url('/') }}/{{ $item->gambar_produk }}"
                                                    data-zoom-image="{{ url('/') }}/{{ $produk->gambar_produk }}"
                                                    alt="qoute-icon"> </li>
                                        @endforeach
                                    </ul>
                                </div>


                            </div>

                            <div class="navigation">
                                <a href="#" class="prev prev-navigation inactive" data-jcarouselcontrol="true">‹</a>
                                <a href="#" class="next next-navigation" data-jcarouselcontrol="true">›</a>
                                <div class="carousel carousel-navigation" data-jcarousel="true">
                                    <ul style="left: 0px; top: 0px;">
                                        <li data-jcarouselcontrol="true" class="active"><img
                                                src="{{ url('/') }}/{{ $produk->gambar_produk }}" width="110"
                                                height="110" alt=""></li>

                                        @foreach ($galeri as $item)
                                            <li data-jcarouselcontrol="true" class="active"><img
                                                    src="{{ url('/') }}/{{ $item->gambar_produk }}" width="110"
                                                    height="110" alt=""></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- / product gallery -->
                    </div>
                    <!-- left side -->

                    <!-- left side -->
                    <!-- right side -->
                    <div class="col-sm-7 col-md-7">
                        <!-- .pro-text -->
                        <div class="pro-text product-detail">
                            <!-- /.pro-img -->


                            <h2>{{ $produk->nama_produk }}</h2>


                            <br>
                            <div class="instock">
                                <ul>

                                    <li class="black-text"><strong class="text-danger">Rp
                                            {{ number_format($produk->harga, 0, ',', '.') }} </strong></li>
                                    @if ($produk->status_produk === 'tersedia')
                                        <li class="black-text"><i class="material-icons green">check_circle</i> tersedia
                                        </li>
                                    @else
                                        <li class="red-text"><i class="material-icons red">cancel</i> tidak tersedia</li>
                                    @endif
                                    <li class="black-text"> Stok : {{ $produk->stok }}
                                    </li>
                                </ul>
                            </div>
                            <br>

                            <br>
                            <div class="alert alert-warning">
                                <div class="font-weight-bold text-yellow"><i class="fa fa-info-circle"></i> Penting</div>
                                <p class="text-secondary mt-1 mb-0">Barang yang tersedia dapat berubah kapan saja tergantung
                                    stok yang ada dari para penjual</p>
                            </div>
                            
                            <img class="img-circle mb-5" height="50px"
                                src="{{ url('/') }}/{{ $produk->img_umkm }}">&nbsp;
                            <strong class="mt-5 "> {{ $produk->nama_umkm }}</strong>&nbsp;
                            <a href="{{ url('/umkm-profil/' . $produk->umkm_id) }}" class="btn btn-primary btn-sm"><i
                                    class="material-icons"></i> Kunjungi
                                toko</a>
                            <br>
                            <br>
                            <h4>Deskripsi Produk</h4>
                            {!! $produk->deskripsi !!}
                            <br>
                            <table class="table table-bordered">
                                <tr>
                                    <td>Nama UMKM</td>
                                    <td>{{ $produk->nama_umkm }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>{{ $produk->alamat }}</td>
                                </tr>
                                <tr>
                                    <td>Nomor Telpon</td>
                                    <td>{{ $produk->no_telp }}</td>
                                </tr>

                            </table>

                            <br>
                            <a href="{{url('/checkout/'.$produk->id)}}" class="addtocart2"><span class="material-icons">shopping_cart</span> Beli
                                Sekarang</a>


                        </div>

                        <!-- /.pro-text -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.shop-deails-bg -->

        <!-- /.grid-shop -->
    </section>
    <section class="best-on-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <!-- title -->
                    <div class="title">
                        <h2>Produk lain<span> UMKM ini </span></h2>
                    </div>
                    <!-- /title -->
                    <!-- electonics -->
                    <div class="electonics ">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="item">
                                    <div class="row">
                                        @foreach ($umkm_produk as $item)
                                            <div class="col-lg-6">
                                                <!-- e-product -->
                                                <div class="e-product e-product2">
                                                    <div class="pro-img">
                                                        <img src="{{ asset($item->gambar_produk) }}" alt="2">
                                                    </div>
                                                    <div class="pro-text-outer">
                                                        <span>{{ $item->nama_produk }}</span>
                                                        <p class="wk-price">Rp
                                                            {{ number_format($item->harga, 0, ',', '.') }} </p>
                                                    </div>
                                                </div>
                                                <!-- /e-product -->
                                            </div>
                                        @endforeach


                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <!-- title -->
                    <div class="title">
                        <h2>Produk <span>terkait</span></h2>
                    </div>
                    <!-- /title -->
                    <!-- electonics -->
                    <div class="electonics ">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="item">
                                    <div class="row">
                                        @foreach ($related_produk as $item)
                                            <div class="col-lg-6">
                                                <!-- e-product -->
                                                <div class="e-product e-product2">
                                                    <div class="pro-img">
                                                        <img src="{{ asset($item->gambar_produk) }}" alt="2">
                                                    </div>
                                                    <div class="pro-text-outer">
                                                        <span>{{ $item->nama_produk }}</span>
                                                        <p class="wk-price">Rp
                                                            {{ number_format($item->harga, 0, ',', '.') }} </p>
                                                    </div>
                                                </div>
                                                <!-- /e-product -->
                                            </div>
                                        @endforeach

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@section('style')
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {});
    </script>
@endsection
