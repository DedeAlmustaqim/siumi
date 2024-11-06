<header class="header2">
    <section class="top-md-menu">
        <div class="container">
            <div class="main-menu">
                <!--  nav  -->
                <nav class="navbar navbar-inverse navbar-default">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="{{url('/')}}"><img src="{{ asset($config->logo) }}" width="200px" alt="logo" /></a>
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" data-hover="dropdown" data-animations=" fadeInLeft fadeInUp fadeInRight">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="{{url('/')}}">Home</a></li>							
                            <li><a href="{{url('/all-kategori')}}">Kategori</a></li>							
                            <li><a href="{{url('/all-umkm')}}">UMKM</a></li>							
                      					
                            {{-- <li class="dropdown">
                                <a href="post-list.html" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span>men</span> <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                <div class="dropdown-menu dropdownhover-bottom mega-menu" role="menu">

                                    <div class="col-sm-8 col-md-8">
                                        <ul>
                                            <li><strong>Women’s Fashion</strong></li>
                                            <li><a href="#">Flip-Flops</a></li>
                                            <li><a href="#">Fashion Scarves</a></li>
                                            <li><a href="#">Wallets</a></li>
                                            <li><a href="#">Evening Handbags</a></li>
                                            <li><a href="#">Wrist Watches</a></li>
                                        </ul>
                                        <ul>
                                            <li><strong>Women’s Accessories</strong></li>
                                            <li><a href="#">Flip-Flops</a></li>
                                            <li><a href="#">Fashion Scarves</a></li>
                                            <li><a href="#">Wallets</a></li>
                                            <li><a href="#">Evening Handbags</a></li>
                                            <li><a href="#">Wrist Watches</a></li>
                                        </ul>
                                        <ul>
                                            <li><strong>Men’s Fashion</strong></li>
                                            <li><a href="#">Flip-Flops</a></li>
                                            <li><a href="#">Fashion Scarves</a></li>
                                            <li><a href="#">Wallets</a></li>
                                            <li><a href="#">Evening Handbags</a></li>
                                            <li><a href="#">Wrist Watches</a></li>
                                        </ul>
                                        <ul>
                                            <li><strong>Men’s Accessories</strong></li>
                                            <li><a href="#">Flip-Flops</a></li>
                                            <li><a href="#">Fashion Scarves</a></li>
                                            <li><a href="#">Wallets</a></li>
                                            <li><a href="#">Evening Handbags</a></li>
                                            <li><a href="#">Wrist Watches</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-4 col-md-4">
                                        <img src="assets/images/01_homepage_v1/banner_image01.jpg" alt="banner">
                                    </div>

                                </div>
                            </li>
                            <li>
                                <a href="#"><span> women</span></a>
                            </li>								
                            <li class="dropdown">
                                <a href="blog.html" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span>Shop</span> <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                <ul class="dropdown-menu dropdownhover-bottom" role="menu">
                                    <li><a href="grid.html">Grid Product</a></li>
                                    <li class="menu-item dropdown dropdown-submenu">
                                        <a href="list.html" class="dropdown-toggle" data-toggle="dropdown">List Product <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                        <ul class="dropdown-menu dropdownhover-left">
                                            <li><a href="list.html">List Product</a></li>
                                            <li><a href="list2.html">List Product2</a></li>
                                        </ul>
                                    </li>
                                    <li class="menu-item dropdown dropdown-submenu">
                                        <a href="shop-detail.html" class="dropdown-toggle" data-toggle="dropdown"><span>Shop Detail</span> <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                          <ul class="dropdown-menu">
                                            <li><a href="shop-detail.html">Shop Detail</a></li>
                                            <li><a href="shop-detail2.html">Shop Detail2</a></li>									
                                        </ul>
                                    </li>
                                    <li class="menu-item dropdown dropdown-submenu"> 
                                        <a href="shopping-cart.html" class="dropdown-toggle" data-toggle="dropdown">Shopping Cart <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                        <ul class="dropdown-menu dropdownhover-left">
                                            <li><a href="shopping-cart.html">Shopping Cart</a></li>
                                            <li><a href="shopping-cart2.html">Shopping Cart2</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                    <li><a href="wishlist.html">Wishlist</a></li>
                                </ul>
                            </li>								
                            <li><a href="#">accessories</a></li>	
                            <li class="dropdown">
                                <a href="blog.html" class="dropdown-toggle" data-toggle="dropdown"><span>other page</span> <i class="fa fa-angle-down" aria-hidden="true"></i></a>
                                <ul class="dropdown-menu dropdownhover-bottom">
                                    <li><a href="about.html">About</a></li>
                                    <li class="menu-item dropdown dropdown-submenu">
                                        <a href="blog.html" class="dropdown-toggle" data-toggle="dropdown"><span>Blog</span> <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                          <ul class="dropdown-menu">
                                            <li><a href="blog.html">Blog</a></li>
                                            <li><a href="blog-columm2.html">Blog Columm2</a></li>
                                            <li><a href="blog-columm2-masonry.html">Blog Columm2 Masonry</a></li>	
                                            <li><a href="blog-columm3.html">Blog Columm3</a></li>	
                                            <li><a href="blog-columm3-masonry.html">Blog Columm3 Masonry</a></li>													
                                        </ul>
                                    </li>
                                    <li><a href="#">404 Error</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="contact.html"><span>contact</span></a>
                            </li>
                            <li><a href="#">buy theme</a></li>
                            <li><a href="wishlist.html"><i class="material-icons">favorite_border</i></a></li>
                            <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span><i class="material-icons"></i></span> <span class="subno">2</span></a>
                            <div class="dropdown-menu cart-outer">
                                <div class="cart-content">
                                    <div class="col-sm-4 col-md-4"><img src="assets/images/01_homepage_v1/product_image_02.jpg" alt="2" /></div>
                                    <div class="col-sm-8 col-md-8">
                                        <div class="pro-text">
                                            <a href="#">Temporibus quibusdam</a>
                                            <span>1 × <span class="price">$290.00</span></span>
                                            <div class="eidt-outer">
                                                <a href="#" class="close"><span class="material-icons">create</span></a>
                                                <a href="#" class="close2"><span class="material-icons">delete</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cart-content">
                                    <div class="col-sm-4 col-md-4"><img src="assets/images/01_homepage_v1/product_image_04.jpg" alt="2" /></div>
                                    <div class="col-sm-8 col-md-8">
                                        <div class="pro-text">
                                            <a href="#">Temporibus quibusdam</a>
                                            <span>1 × <span class="price">$290.00</span></span>
                                            <div class="eidt-outer">
                                                <a href="#" class="close"><span class="material-icons">create</span></a>
                                                <a href="#" class="close2"><span class="material-icons">delete</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="total">
                                    <div class="col-md-6 text-left">											
                                        <strong class="sub-total">Sub Total</strong>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <strong>$160.00</strong>
                                    </div>
                                </div>
                                <a href="shopping-cart.html" class="cart-btn"><span class="material-icons"></span> VIEW CART </a>
                                <a href="checkout.html" class="cart-btn"><span class="material-icons">reply</span> CHECKOUT</a>
                            </div> --}}
                        </li>
                            
                            
                        </ul>
                        <!-- /.navbar-collapse -->
                    </div>
                </nav>
                <!-- /nav end -->

            </div>
        </div>
    </section>
</header>