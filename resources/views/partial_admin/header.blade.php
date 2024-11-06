<head>

    <title>{{$title}}</title>
    <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 11]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description"
        content="SiUMi BarTim" />
    <meta name="keywords"
        content="SiUMi BarTim">
    <meta name="author" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset($config->logo) }}" type="image/x-icon">
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="{{ asset('assets_admin/fonts/fontawesome/css/fontawesome-all.min.css') }}">
    <!-- animation css -->
    <link rel="stylesheet" href="{{ asset('assets_admin/plugins/animation/css/animate.min.css') }}">

    <!-- notification css -->
    <link rel="stylesheet" href="{{ asset('assets_admin/plugins/notification/css/notification.min.css') }}">

    <!-- vendor css -->
    <link rel="stylesheet" href="{{ asset('assets_admin/css/style.css') }}">

     <!-- data tables css -->
     <link rel="stylesheet" href="{{ asset('assets_admin/plugins/data-tables/css/datatables.min.css') }}">
     <link rel="stylesheet" href="{{ asset('assets_admin/js/plugins/jquery-toast-plugin-master/dist/jquery.toast.min.css') }}">
     <link rel="stylesheet" href="{{ asset('assets_admin/css/plugins/select2.min.css') }}">
     <link rel="stylesheet" href="{{ asset('assets_admin/js/plugins/quill/quill.core.css') }}">
     <link rel="stylesheet" href="{{ asset('assets_admin/js/plugins/quill/quill.snow.css') }}">

      <!--lightbox css -->
      <link rel="stylesheet" href="{{ asset('assets_admin/plugins/lightbox2-master/css/lightbox.min.css') }}">

</head>