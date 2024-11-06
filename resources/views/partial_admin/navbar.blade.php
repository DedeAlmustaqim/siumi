  <!-- [ navigation menu ] start -->
  <nav class="pcoded-navbar menupos-fixed menu-light menu-item-icon-style6 ">
      <div class="navbar-wrapper ">
          <div class="navbar-brand header-logo bg-light">
              <a href="{{ url('/') }}" class="b-brand">

                  <img src="{{ asset($config->logo) }}" alt="" width="150px" class="logo images">
                  <img src="{{ asset($config->logo) }}" alt="" width="150px" class="logo-thumb images">
              </a>
              {{-- <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a> --}}
          </div>
          <div class="navbar-content scroll-div   " id="layout-sidenav">



              <ul class="nav pcoded-inner-navbar sidenav-inner">
                  <li class="nav-item pcoded-menu-caption">
                      <label>Navigasi</label>
                  </li>
                  {{-- <li data-username="dashboard default ecommerce sales Helpdesk ticket CRM analytics project"
                      class="nav-item pcoded-hasmenu">
                      <a href="#!" class="nav-link"><span class="pcoded-micon"><i
                                  class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                      <ul class="pcoded-submenu">
                          <li class=""><a href="index.html" class="">Analytics</a></li>
                          <li class=""><a href="dashboard-sale.html" class="">Sales</a></li>
                          <li class=""><a href="dashboard-project.html" class="">Project</a></li>
                          <li class=""><a href="dashboard-help.html" class="">Helpdesk<span
                                      class="pcoded-badge label label-danger">NEW</span></a></li>
                      </ul>
                  </li> --}}

                  <li class="nav-item"><a href="{{ url('/admin/dashboard') }}" class="nav-link"><span
                              class="pcoded-micon"><i class="feather icon-home"></i></span><span
                              class="pcoded-mtext">Dashboard</span></a></li>
                  <li class="nav-item"><a href="{{ url('/admin/umkm') }}" class="nav-link"><span class="pcoded-micon"><i
                                  class="fas fa-store"></i></span><span class="pcoded-mtext">UMKM</span></a></li>
                  <li class="nav-item"><a href="{{ url('/admin/kategori') }}" class="nav-link"><span
                              class="pcoded-micon"><i class="fas fa-list"></i></span><span
                              class="pcoded-mtext">KATEGORI</span></a></li>
                  <li class="nav-item"><a href="{{ url('/admin/produk') }}" class="nav-link"><span
                              class="pcoded-micon"><i class="fas fa-shopping-bag"></i></span><span
                              class="pcoded-mtext">PRODUK</span></a></li>
                  <li data-username="dashboard default ecommerce sales Helpdesk ticket CRM analytics project"
                      class="nav-item pcoded-hasmenu">
                      <a href="#!" class="nav-link"><span class="pcoded-micon"><i
                                  class="feather icon-shopping-cart"></i></span><span class="pcoded-mtext">TRANSAKSI</span></a>
                      <ul class="pcoded-submenu">
                          <li class=""><a href="{{ url('/admin/checkout-list') }}" class="">Daftar Pesanan</a></li>
                          </a>
                  </li>
              </ul>
              </li>
              <li data-username="dashboard default ecommerce sales Helpdesk ticket CRM analytics project"
                  class="nav-item pcoded-hasmenu">
                  <a href="#!" class="nav-link"><span class="pcoded-micon"><i
                              class="feather icon-settings"></i></span><span class="pcoded-mtext">SETTING</span></a>
                  <ul class="pcoded-submenu">
                      <li class=""><a href="{{ url('/admin/config') }}" class="">Aplikasi</a></li>
                      </a>
              </li>
              </ul>
              </li>


              </ul>



          </div>

      </div>
  </nav>
  <!-- [ navigation menu ] end -->

  <!-- [ Header ] start -->
  <header class="navbar pcoded-header navbar-expand-lg navbar-light headerpos-fixed">


      <div class="m-header">
          <a class="mobile-menu" id="mobile-collapse1" href="#!"><span></span></a>
          <a href="index.html" class="b-brand">
              <img src="{{ asset($config->logo) }}" alt="" width="150px" class="logo images">
              <img src="{{ asset($config->logo) }}" alt="" width="150px" class="logo-thumb images">
          </a>
      </div>
      <a class="mobile-menu" id="mobile-header" href="#!">
          <i class="feather icon-more-horizontal"></i>
      </a>
      <div class="collapse navbar-collapse">


          <ul class="navbar-nav ms-auto">

              <li>
                  <div class="dropdown drp-user">
                      <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                          <i class="icon feather icon-settings"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-end profile-notification">
                          <div class="pro-head">
                              {{-- <img src="assets/images/user/avatar-1.jpg" class="img-radius" alt="User-Profile-Image"> --}}
                              <span>
                                  <span class="text-muted">{{ session('name') }}</span>
                                  <span class="h6">{{ session('email') }}</span>
                              </span>
                          </div>
                          <ul class="pro-body">
                              <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                  style="display: none;">
                                  @csrf
                              </form>
                              <li><a href="#"
                                      onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                      class="dropdown-item"><i class="feather icon-power text-danger"></i> Logout</a>
                              </li>





                          </ul>
                      </div>
                  </div>
              </li>
          </ul>
      </div>

  </header>
  <!-- [ Header ] end -->


  <!-- [ chat user list ] start -->
  <section class="header-user-list">
      <a href="#!" class="h-close-text"><i class="feather icon-x"></i></a>
      <ul class="nav nav-tabs" id="chatTab" role="tablist">
          <li class="nav-item">
              <a class="nav-link active text-uppercase" id="chat-tab" data-bs-toggle="tab" href="#chat"
                  role="tab" aria-controls="chat" aria-selected="true"><i
                      class="feather icon-message-circle me-2"></i>Chat</a>
          </li>
          <li class="nav-item">
              <a class="nav-link text-uppercase" id="user-tab" data-bs-toggle="tab" href="#user" role="tab"
                  aria-controls="user" aria-selected="false"><i class="feather icon-users me-2"></i>User</a>
          </li>
          <li class="nav-item">
              <a class="nav-link text-uppercase" id="setting-tab" data-bs-toggle="tab" href="#setting"
                  role="tab" aria-controls="setting" aria-selected="false"><i
                      class="feather icon-settings me-2"></i>Setting</a>
          </li>
      </ul>
     
  </section>

