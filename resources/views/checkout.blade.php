@extends('layouts.app')

@section('content')
    <section class="shopping-cart">

        <!-- .shopping-cart -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <table>
                        <tbody>
                            <tr>
                                <th width="15%" class="text-center"></th>

                                <th width="25%">Nama Produk</th>
                                <th width="15%">Harga</th>
                                <th width="15%">Kuantitas</th>
                                <th width="15%">Subtotal</th>

                            </tr>
                            <form method="POST" action="{{ url('/checkout') }}">
                                <input type="hidden" value="{{$produk->id}}" name="id_produk_co">
                                @csrf
                                <tr>
                                    <td><img src="{{ url('/' . $produk->gambar_produk) }}" width="150px" alt="13">
                                    </td>

                                    <td><strong>
                                            <h2>{{ $produk->nama_produk }}</h2>
                                        </strong></td>
                                    <td><strong>
                                            <h2>Rp {{ number_format($produk->harga, 0, ',', '.') }}</h2>
                                        </strong></td>
                                    <input type="hidden" id="harga_function" name="harga" value="{{ $produk->harga }}">

                                    <td><input type="number" id="quantity_function" name="kuantitas" min="1"
                                            max="500" value="1"></td>

                                    <td>
                                        <input type="hidden" id="total_function" name="total"
                                            value="{{ $produk->harga }}" readonly>
                                        <strong id="harga_total">Rp
                                            {{ number_format($produk->harga, 0, ',', '.') }}</strong>
                                    </td>

                                </tr>
                        </tbody>
                    </table>

                    <div class="col-lg-8">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="shipping-outer">
                            <div class="col-lg-6">
                                <div class="row">
                                    <div class="col-md-12 counttry">
                                        <div class="lable">Nama</div>
                                        <input name="nama" placeholder="" type="text">
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="counttry">
                                    <div class="lable">No HP</div>
                                    <input name="no_hp_co" placeholder="" type="text">

                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="counttry">
                                    <div class="lable">Catatan Pesanan   <small>(Optional)</small></div>
                                    <textarea cols="3" name="catatan" class="form-control"></textarea>
                                </div>
                              

                            </div>
                            <div class="col-lg-12">
                                <div class="counttry">
                                    <div class="lable">Alamat</div>
                                    <textarea cols="3" name="alamat" class="form-control"></textarea>
                                </div>

                            </div>
                            <div class="col-lg-12">
                                <div class="counttry">
                                    <div class="lable">Kabupaten</div>
                                    <input name="kabupaten" placeholder="" type="text">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="counttry">
                                    <div class="lable">Kecamatan</div>
                                    <input name="kecamatan" placeholder="" type="text">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="counttry">
                                    <div class="lable">Kelurahan/Desa</div>
                                    <input name="kelurahan" placeholder="" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="shipping-outer">
                            <h2>Total Belanja</h2>
                            <ul>
                                <li>Total: <strong id="harga_total2">Rp
                                        {{ number_format($produk->harga, 0, ',', '.') }}</strong></li>
                                <li>
                                    <div class="alert alert-warning">
                                        <div class="font-weight-bold text-yellow"><i class="fa fa-info-circle"></i> Penting
                                        </div>
                                        <p class="text-secondary mt-1 mb-0">Rincian pesanan anda akan kami teruskan
                                            menggunakan WhatsApp ke penjual untuk proses selanjutnya</p>
                                    </div>
                                </li>
                                <li class="text-center">
                                    <button type="submit" class="redbutton">Proses Pesanan</a>

                                </li>
                                </form>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.shopping-cart -->
    </section>
@endsection

@section('style')
@endsection

@push('scripts')
    <script src="{{ asset('assets/js/filter-price.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script>
        $(document).ready(function() {
            loadProvinsi()
            // Ambil nilai harga awal
            $('#quantity_function').val(1);
            var harga = parseFloat($('#harga_function').val());

            // Format harga awal dan tetapkan sebagai default di #harga_total
            var formattedHarga = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(harga);

            $('#harga_total').text(formattedHarga); // Set default

            // Event ketika quantity diubah
            $('#quantity_function').on('input', function() {
                var quantity = parseInt($(this).val()) || 1;
                var total = harga * quantity;

                var formattedTotal = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }).format(total);

                $('#total_function').val(formattedTotal);
                $('#harga_total').text(formattedTotal); // Update dengan total baru
                $('#harga_total2').text(formattedTotal); // Update dengan total baru
            });

            $('#provinsi_select').change(function() {
                var provinceId = $(this).val(); // Ambil ID provinsi yang dipilih

                // Kosongkan dan nonaktifkan dropdown kabupaten
                $('#kabupaten_select').empty().append('<option value="">-- Pilih Kabupaten --</option>')
                    .prop('disabled', true);

                if (provinceId) {
                    $.ajax({
                        url: BASE_URL + `/api/regencies/${provinceId}`,
                        type: "GET",
                        dataType: "json",
                        success: function(response) {
                            // Loop melalui setiap kabupaten
                            $.each(response, function(index, regency) {
                                // Tambahkan setiap kabupaten sebagai option
                                $('#kabupaten_select').append(
                                    $('<option>', {
                                        value: regency.id, // ID kabupaten
                                        text: regency.name // Nama kabupaten
                                    })
                                );
                            });
                            // Aktifkan dropdown kabupaten setelah data dimuat
                            $('#kabupaten_select').prop('disabled', false);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert("Gagal mengambil data kabupaten. Error: " + errorThrown);
                        }
                    });
                }
            });
        });

        function loadProvinsi() {
            $.ajax({
                url: "http://www.emsifa.com/api-wilayah-indonesia/api/provinces.json",
                type: "GET",
                dataType: "json",
                cache: false, // Menonaktifkan cache agar selalu mengambil data terbaru
                success: function(response) {
                    // Loop melalui setiap provinsi
                    $.each(response, function(index, province) {
                        // Tambahkan setiap provinsi sebagai option
                        $('#provinsi_select').append(
                            $('<option>', {
                                value: province.id, // ID provinsi
                                text: province.name // Nama provinsi
                            })
                        );
                    });
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert("Gagal mengambil data provinsi. Error: " + errorThrown);
                }
            });

        }
    </script>
@endpush
