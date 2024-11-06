@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-8">
            <div class="card p-2">
                <h4>{{ $title }}</h4>
                <div class="card-body">
                    <div class="container">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form class="" action="{{ url('/profil-update') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="user_name">Nama</label>
                                <input type="text" name="user_name" id="user_name" class="form-control"
                                    value="{{ old('user_name', $user->name) }}" placeholder="" aria-describedby="helpId">
                                @error('user_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="user_email">Email</label>
                                <input type="email" name="user_email" id="user_email" class="form-control"
                                    value="{{ old('user_email', $user->email) }}" placeholder="" aria-describedby="helpId">
                                @error('user_email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="user_no_hp">No Hp</label>
                                <input type="text" name="user_no_hp" id="user_no_hp" class="form-control"
                                    value="{{ old('user_no_hp', $user->no_hp) }}" placeholder="" aria-describedby="helpId">
                                @error('user_no_hp')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary float-end">Simpan</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card p-2">
                <h4 class="card-title center">Logo</h4>

                <div class="card-body center">

                    <form action="{{ url('/setting-update-logo') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" value="{{ $config->id }}" name="id_config">
                        <div class="form-group">
                            <img src="{{ url('/') . $config->logo }}"
                                class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}"
                                alt="">
                        </div>
                        <div class="form-group">
                            <label for=""></label>
                            <input type="file" class="form-control-file" name="logo" id="" placeholder=""
                                aria-describedby="fileHelpId">
                        </div>

                        <button type="submit" class="btn btn-primary float-end">Simpan</button>
                    </form>
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
