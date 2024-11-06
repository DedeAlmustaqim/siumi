<!DOCTYPE html>
<html lang="en">

@include('partial/header')

<body class="inside">
    <!--  Preloader  -->
    {{-- <div id="preloader" class="loader-wrapper">
        <div id="loading" class="loader"></div>
    </div> --}}
    @include('partial/menu')
    <!-- newsletter -->
    <section class="grid-shop">
        <!-- .grid-shop -->
        <div class="breadcrumb">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <ol>
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active">{{$title}}</li>
                        </ol>
                    </div>
                    <div class="col-md-4 text-right">
                        <h2>{{$title}}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            @yield('content')
        </div>
        <!-- /.grid-shop -->
    </section>
    @include('partial/footer')
    <!--  quick popup  -->
    <div class="modal fade bwidth" id="quickModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <!-- .shop-deails-bg -->

                    <div class="row">
                        <!-- left side -->
                        <div class="col-sm-5 col-md-5">
                            <!-- product gallery -->
                            <div class="connected-carousels">
                                <div class="stage">
                                    <div class="carousel carousel-stage">
                                        <ul>
                                            <li><img class="zoom_01"
                                                    src="assets/images/07_product_detail_page/quick_view_product_image_01.jpg"
                                                    data-zoom-image="assets/images/07_product_detail_page/quick_view_product_image_01.jpg"
                                                    alt="qoute-icon" /> </li>
                                            <li><img class="zoom_01"
                                                    src="assets/images/07_product_detail_page/quick_view_product_image_01.jpg"
                                                    data-zoom-image="assets/images/07_product_detail_page/similar_product_image_02.jpg"
                                                    alt="qoute-icon" /></li>
                                            <li><img class="zoom_01"
                                                    src="assets/images/07_product_detail_page/quick_view_product_image_01.jpg"
                                                    data-zoom-image="assets/images/07_product_detail_page/similar_product_image_03.jpg"
                                                    alt="qoute-icon" /></li>
                                            <li><img class="zoom_01"
                                                    src="assets/images/07_product_detail_page/quick_view_product_image_01.jpg"
                                                    data-zoom-image="assets/images/07_product_detail_page/similar_product_image_04.jpg"
                                                    alt="qoute-icon" /> </li>
                                            <li><img class="zoom_01"
                                                    src="assets/images/07_product_detail_page/quick_view_product_image_01.jpg"
                                                    data-zoom-image="assets/images/07_product_detail_page/similar_product_image_05.jpg"
                                                    alt="qoute-icon" /></li>
                                            <li><img class="zoom_01"
                                                    src="assets/images/07_product_detail_page/quick_view_product_image_01.jpg"
                                                    data-zoom-image="assets/images/07_product_detail_page/similar_product_image_01.jpg"
                                                    alt="qoute-icon" /></li>
                                        </ul>
                                    </div>
                                    <p class="photo-credits">
                                        Photos by <a href="http://www.mw-fotografie.de">Marc Wiegelmann</a>
                                    </p>
                                    <a href="#" class="prev prev-stage"><span>&lsaquo;</span></a>
                                    <a href="#" class="next next-stage"><span>&rsaquo;</span></a>
                                </div>

                                <div class="navigation">
                                    <a href="#" class="prev prev-navigation">&lsaquo;</a>
                                    <a href="#" class="next next-navigation">&rsaquo;</a>
                                    <div class="carousel carousel-navigation">
                                        <ul>
                                            <li><img src="assets/images/07_product_detail_page/similar_product_image_01.jpg"
                                                    width="110" height="110" alt=""></li>
                                            <li><img src="assets/images/07_product_detail_page/similar_product_image_02.jpg"
                                                    width="110" height="110" alt=""></li>
                                            <li><img src="assets/images/07_product_detail_page/similar_product_image_03.jpg"
                                                    width="110" height="110" alt=""></li>
                                            <li><img src="assets/images/07_product_detail_page/similar_product_image_04.jpg"
                                                    width="110" height="110" alt=""></li>
                                            <li><img src="assets/images/07_product_detail_page/similar_product_image_01.jpg"
                                                    width="110" height="110" alt=""></li>
                                            <li><img src="assets/images/07_product_detail_page/similar_product_image_02.jpg"
                                                    width="110" height="110" alt=""></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- / product gallery -->
                        </div>
                        <!-- left side -->
                        <!-- right side -->
                        <div class="col-sm-7 col-md-7">
                            <!-- .pro-text -->
                            <div class="pro-text product-detail">
                                <!-- /.pro-img -->
                                <span class="span1">T-shirt, Skirts</span>
                                <a href="#">
                                    <h4>Bonorum et Malorum</h4>
                                </a>
                                <p><strong>$450.00 </strong><span class="line-through">$890.00</span></p>
                                <div class="instock">
                                    <ul>
                                        <li class="black-text"><i class="material-icons green">check_circle</i> In
                                            stock</li>
                                        <li><i class="material-icons">card_giftcard</i> offers</li>
                                    </ul>
                                </div>
                                <div class="star2">
                                    <ul>
                                        <li class="yellow-color"><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li class="yellow-color"><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li class="yellow-color"><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li class="yellow-color"><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                        <li><a href="#">10 review(s)</a></li>
                                        <li><a href="#"> Add your review</a></li>
                                    </ul>
                                </div>

                                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque
                                    laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi
                                    architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia
                                    voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur.</p>
                                <div class="size">
                                    <p><strong>Select size :</strong></p>
                                    <ul>
                                        <li><a href="#">S</a></li>
                                        <li><a href="#">M</a></li>
                                        <li><a href="#">L</a></li>
                                        <li><a href="#">X</a></li>
                                        <li><a href="#">XL</a></li>
                                    </ul>
                                </div>

                                <form>
                                    <div class="numbers-row">
                                        <input type="text" name="french-hens" id="french-hens" value="3">
                                    </div>
                                </form>
                                <a href="#" class="addtocart2"><span
                                        class="material-icons">shopping_cart</span> Add to cart</a>
                                <a href="#" class="hart"><span
                                        class="material-icons">favorite_border</span></a>
                                <a href="#" class="hart"><span class="material-icons">sort</span></a>
                                <a href="#" class="hart"><span class="material-icons">share</span></a>

                            </div>
                            <!-- /.pro-text -->
                        </div>
                    </div>
                    <!-- /.shop-deails-bg -->
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <p id="back-top" style="display: block;"> <a href="#top"><i class="fa fa-chevron-up"
                aria-hidden="true"></i></a> </p>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-dropdownhover.min.js') }}"></script>
    <!-- Plugin JavaScript -->
    <script src="{{ asset('assets/js/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <!-- owl carousel -->
    <script src="{{ asset('assets/owl-carousel/owl.carousel.js') }}"></script>
    <!--  Custom Theme JavaScript  -->
    <script src="{{ asset('assets/js/filter-price.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <!--  jcarousel Theme JavaScript  -->
    <script type="text/javascript" src="{{ asset('assets/js/jquery.jcarousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jcarousel.connected-carousels.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.elevatezoom.js') }}"></script>
    <script src="{{ asset('assets_admin/plugins/lightbox2-master/js/lightbox.min.js') }}"></script>
	<script>
		$('.zoom_01').elevateZoom({
			zoomType: "inner",
			cursor: "crosshair",
			zoomWindowFadeIn: 500,
			zoomWindowFadeOut: 750
		});
	</script>
    <script>
        var BASE_URL = "{{ url('/') }}";
        
        function formatRupiah(angka) {
            let rupiah = angka.toString().split('').reverse().join('');
            rupiah = rupiah.match(/\d{1,3}/g).join('.').split('').reverse().join('');
            return "Rp " + rupiah;
        }
    </script>
    @stack('scripts')
</body>

</html>
