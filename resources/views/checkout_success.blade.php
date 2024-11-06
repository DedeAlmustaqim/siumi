@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
       
        <div class="alert alert-success">
            <div class="font-weight-bold text-yellow"><h2><i class="material-icons green">check_circle</i> &nbsp; Berhasil</h2></div>
            <br>
         <hr>
         <br>
            <h4>Pesananan anda akan kami teruskan ke penjual melalui WhatsApp Server kami</h4>
            <br>
            <div class="text-center">
                <a href="{{url('/')}}" class="btn btn-primary"><span class="material-icons">shopping_cart</span> Lanjutkan Belanja</a>
            </div>
        </div>
    </div>
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
