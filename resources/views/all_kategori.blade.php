@extends('layouts.app')

@section('content')

<div class="container">
    <div class="title text-center">
        <h2>Semua Kategori</h2>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <!-- title -->
            
            <!-- /title -->
            <!-- electonics -->
            <div class="electonics ">
                <div class="col-md-12">
                    <div class="row">
                        <div class="item">
                            <div class="row">
                                @foreach ($kategori as $item)
                                    <div class="col-lg-4">
                                        <!-- e-product -->
                                        <div class="e-product e-product2">
                                            <a href="{{ url('/kategori/' . $item->id) }}">
                                                <div class="pro-text-outer">
                                                    <p class="wk-price">
                                                        {{ $item->nama_kategori }} </p>
                                                        <span>{{ $item->deskripsi }}</span>
                                                </div>
                                            </a>
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
@endsection

@section('style')
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {});
    </script>
@endsection
