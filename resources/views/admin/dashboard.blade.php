@extends('layouts_admin.app')

@section('content')
    <div class="row">

        <div class="col-xl-6 col-md-12">

            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="widget-profile-card-2">
                        <img class="img-fluid img-thumbnail" src="{{ asset($config->logo) }}" alt="Profile-user">
                    </div>
                    <div class="card-body text-center">
                        <h3>{{ $config->app_name }}</h3>
                        <p>{{ $config->instansi }}</p>
                        <p>{{ $config->tentang }}
                        </p>
                    </div>
                    <div class="card-footer bg-inverse">
                        <div class="row text-center">

                            <p> {{ $config->alamat }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="card bg-c-blue order-card">
                        <div class="card-body">
                            <h6 class="m-b-20">Jumlah UMKM</h6>
                            <h2 class="text-start"><span>{{ $countUmkm }}</span><i class="fas fa-store float-end"></i>
                            </h2>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-c-green order-card">
                        <div class="card-body">
                            <h6 class="m-b-20">Jumlah Produk</h6>
                            <h2 class="text-start"><span>{{ $countProduk }}</span><i
                                    class="fas fa-shopping-bag float-end"></i></h2>

                        </div>
                    </div>
                </div>

            </div>
            <div class="card">
                <div class="card user-list table-card">
                    <div class="card-header">
                        <h5>Jumlah Produk berdasarkan UMKM</h5>
                        <div class="card-header-right">
                            <div class="btn-group card-option">
                                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="feather icon-more-horizontal"></i>
                                </button>
                                <ul class="list-unstyled card-option dropdown-menu dropdown-menu-end">
                                    <li class="dropdown-item full-card"><a href="#!"><span><i
                                                    class="feather icon-maximize"></i>
                                                maximize</span><span style="display:none"><i
                                                    class="feather icon-minimize"></i>
                                                Restore</span></a></li>
                                    <li class="dropdown-item minimize-card"><a href="#!"><span><i
                                                    class="feather icon-minus"></i> collapse</span><span
                                                style="display:none"><i class="feather icon-plus"></i>
                                                expand</span></a></li>


                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <div class="table-responsive">
                            <div class="user-scroll ps ps--active-y" style="height:430px;position:relative;">
                                <table class="table table-hover m-0">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>UMKM</th>
                                            <th>Jumlah Produk</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($umkm as $item)
                                            <tr>
                                                <td><img class="rounded-circle" style="width:40px;"
                                                        src="{{ url('/'.$item->img_umkm) }}" alt="activity-user"></td>
                                                <td>
                                                    <h6 class="mb">{{ $item->nama_umkm }}</h6>
                                                    <p>{{ $item->pemilik }}</p>

                                                </td>
                                                <td>{{ $item->jumlah_produk }}</td>

                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                </div>
                                <div class="ps__rail-y" style="top: 0px; height: 430px; right: 0px;">
                                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 351px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // [ user-scroll ] start
            var px = new PerfectScrollbar('.user-scroll', {
                wheelSpeed: .5,
                swipeEasing: 0,
                wheelPropagation: 1,
                minScrollbarLength: 40,
            });
            // [ user-scroll ] end
        });
    </script>
@endpush
