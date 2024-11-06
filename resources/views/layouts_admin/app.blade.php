<!DOCTYPE html>
<html lang="en">

@include('partial_admin/header')

<body class="">
    <!-- [ Pre-loader ] start -->
    {{-- <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div> --}}
    <!-- [ Pre-loader ] End -->
    @include('partial_admin/navbar')




    <!-- [ Main Content ] start -->
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <div class="main-body">
                        <div class="page-wrapper">
                            <!-- [ breadcrumb ] start -->
                            <div class="page-header">
                                <div class="page-block">
                                    <div class="row align-items-center">
                                        <div class="col-md-12">
                                            <div class="page-header-title">
                                                <h5>Home</h5>
                                            </div>
                                            <ul class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}"><i
                                                            class="feather icon-home"></i></a></li>
                                                <li class="breadcrumb-item">{{ $title }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- [ breadcrumb ] end -->
                            <!-- [ Main Content ] start -->
                            @yield('content')

                            <!-- [ Main Content ] end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->

    <!-- Warning Section start -->
    <!-- Older IE warning message -->
    <!--[if lt IE 11]>
        <div class="ie-warning">
            <h1>Warning!!</h1>
            <p>You are using an outdated version of Internet Explorer, please upgrade
               <br/>to any of the following web browsers to access this website.
            </p>
            <div class="iew-container">
                <ul class="iew-download">
                    <li>
                        <a href="http://www.google.com/chrome/">
                            <img src="assets/images/browser/chrome.png" alt="Chrome">
                            <div>Chrome</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.mozilla.org/en-US/firefox/new/">
                            <img src="assets/images/browser/firefox.png" alt="Firefox">
                            <div>Firefox</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://www.opera.com">
                            <img src="assets/images/browser/opera.png" alt="Opera">
                            <div>Opera</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.apple.com/safari/">
                            <img src="assets/images/browser/safari.png" alt="Safari">
                            <div>Safari</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                            <img src="assets/images/browser/ie.png" alt="">
                            <div>IE (11 & above)</div>
                        </a>
                    </li>
                </ul>
            </div>
            <p>Sorry for the inconvenience!</p>
        </div>
    <![endif]-->
    <!-- Warning Section Ends -->

    <!-- Required Js -->
    <script src="{{ asset('assets_admin/js/vendor-all.min.js') }}"></script>
    <script src="{{ asset('assets_admin/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets_admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets_admin/js/pcoded.min.js') }}"></script>
    {{-- <script src="{{ asset('assets_admin/js/menu-setting.js') }}"></script> --}}

    <script src="{{ asset('assets_admin/plugins/data-tables/js/datatables.min.js') }}"></script>
    <script src="{{ asset('assets_admin/js/pages/data-basic-custom.js') }}"></script>
    <!-- notification Js -->
    <script src="{{ asset('assets_admin/js/plugins/jquery-toast-plugin-master/dist/jquery.toast.min.js') }}"></script>

    <script src="{{ asset('assets_admin/plugins/sweetalert/js/sweetalert.min.js') }}"></script>
    <!-- Input mask Js -->
    <script src="{{ asset('assets_admin/js/plugins/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('assets_admin/js/plugins/select2.full.min.js') }}"></script>
    <script src='{{ asset('assets_admin/js/plugins/quill/quill.min.js') }}'></script>







    {{-- <div class="footer-fab">
        <div class="b-bg">
            <i class="fas fa-question"></i>
        </div>
        <div class="fab-hover">
            <ul class="list-unstyled">
                <li><a href="../doc/index-bc-package.html" target="_blank" data-text="UI Kit"
                        class="btn btn-icon btn-rounded btn-info m-0"><i class="feather icon-layers"></i></a></li>
                <li><a href="../doc/index.html" target="_blank" data-text="Document"
                        class="btn btn-icon btn-rounded btn-primary m-0"><i
                            class="feather icon feather icon-book"></i></a></li>
            </ul>
        </div> --}}
    </div>

    <script>
        var BASE_URL = "{{ url('/') }}";
        $(document).ready(function() {
            $('.mob_no').mask('+6200000000000');
            $('.rupiah').mask('000.000.000.000.000', {
                reverse: true
            });
            $('.int').mask('000000', {
                reverse: true
            });

            

            // Inisialisasi global untuk semua modal yang muncul
            $(document).on('hidden.bs.modal', function() {
                $(this).find('form').trigger('reset');
            });

            $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
                return {
                    "iStart": oSettings._iDisplayStart,
                    "iEnd": oSettings.fnDisplayEnd(),
                    "iLength": oSettings._iDisplayLength,
                    "iTotal": oSettings.fnRecordsTotal(),
                    "iFilteredTotal": oSettings.fnRecordsDisplay(),
                    "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                    "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                };
            };
        })
    </script>
    @stack('scripts')
</body>

</html>
