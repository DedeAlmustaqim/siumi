@extends('layouts_admin.app')

@section('content')
    <div class="row">
        <!-- Zero config table start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{ $title }}</h5>
                </div>
                <div class="card-body">


                    <div class="table-responsive dt-responsive">
                        <div id="dt-ajax-array_wrapper" class="dataTables_wrapper dt-bootstrap4">

                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="tblPesanan" class="table table-striped table-bordered nowrap dataTable"
                                        role="grid" aria-describedby="dt-ajax-array_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" width="5%" tabindex="0"
                                                    aria-controls="dt-ajax-array" rowspan="1" colspan="1">No</th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="dt-ajax-array"
                                                    rowspan="1" colspan="1"></th>
                                                    <th class="sorting_asc" tabindex="0" aria-controls="dt-ajax-array"
                                                    rowspan="1" colspan="1">Nama Produk</th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="dt-ajax-array"
                                                    rowspan="1" colspan="1">Nama UMKM</th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="dt-ajax-array"
                                                    rowspan="1" colspan="1">Nama Pemesan</th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="dt-ajax-array"
                                                    rowspan="1" colspan="1">No Pemesan</th>

                                                <th class="sorting_asc" tabindex="0" aria-controls="dt-ajax-array"
                                                    rowspan="1" colspan="1">Kuantitas</th>
                                                <th class="sorting_asc" width="10%" tabindex="0"
                                                    aria-controls="dt-ajax-array" rowspan="1" colspan="1">Total
                                                    Pembayaran</th>
                                                <th class="sorting_asc" width="10%" tabindex="0"
                                                    aria-controls="dt-ajax-array" rowspan="1" colspan="1">Tanggal
                                                    Pesanan</th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr class="odd">
                                                <td valign="top" colspan="6" class="dataTables_empty">Memuat...</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection



    @push('scripts')
        <script>
            $(document).ready(function() {


                show()
            });

            function formatRupiah(angka) {
                return "Rp " + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            function formatTanggal(dateTimeString) {
                const bulan = [
                    "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                ];

                // Ubah dateTimeString menjadi objek Date
                const date = new Date(dateTimeString);

                // Dapatkan bagian-bagian dari tanggal
                const hari = date.getDate();
                const bulanNama = bulan[date.getMonth()];
                const tahun = date.getFullYear();

                // Dapatkan bagian-bagian dari waktu
                const jam = String(date.getHours()).padStart(2, '0');
                const menit = String(date.getMinutes()).padStart(2, '0');

                // Gabungkan menjadi format yang diinginkan
                return `${hari} ${bulanNama} ${tahun} ${jam}:${menit}`;
            }

            function show() {


                $('#tblPesanan').DataTable({
                    processing: true,
                    serverSide: true,
                    destroy: true,
                    "ajax": {
                        url: BASE_URL + "/admin/checkout-data",
                        data: function(d) {
                            // d.id = $('#ptDropdown').val(); // Mengambil nilai dari dropdown perusahaan

                        }
                    },
                    "displayLength": 25,
                    "columns": [{
                            "orderable": false,
                            "data": function(data) {
                                return '<div class="text-left">' + data.id + '</div>'
                            }
                        },
                        {
                            "orderable": false,
                            "data": function(data) {
                                return '<div class="text-center"><img src="' + BASE_URL + ' /' + data
                                    .gambar_produk +
                                    '" height="60px"></div>'
                            }
                        },
                        {
                            "orderable": false,
                            "data": function(data) {
                                return '<div class="text-left">' + data.nama_produk + '</div>'
                            }
                        },
                        {
                            "orderable": false,
                            "data": function(data) {
                                return '<div class="text-left">' + data.nama_umkm + '</div>'
                            }
                        },
                        {
                            "orderable": false,
                            "data": function(data) {
                                return '<div class="text-left">' + data.nama + '</div>'
                            }
                        },
                        {
                            "orderable": false,
                            "data": function(data) {
                                return '<div class="text-left">' + data.no_hp_co + '</div>'
                            }
                        },

                        {
                            "orderable": false,
                            "data": function(data) {
                                return '<div class="text-left">' + data.kuantitas + '</div>'
                            }
                        },
                        {
                            "orderable": false,
                            "data": function(data) {
                                return '<div class="text-left">' + formatRupiah(data.total) + '</div>'
                            }
                        },
                        {
                            "orderable": false,
                            "data": function(data) {
                                return '<div class="text-left">' + formatTanggal(data.created_at) + '</div>'
                            }
                        },
                    ],
                    rowCallback: function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        $('td:eq(0)', row).html(index);
                    },
                });
            }
        </script>
    @endpush
