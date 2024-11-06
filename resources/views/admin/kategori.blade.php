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
                    <a href="javascript:void(0)" data-bs-target="#modalAddKategori" data-bs-toggle="modal"
                        class="toggle btn btn-primary d-none d-md-inline-flex">
                        <span><i class="fa fa-plus" aria-hidden="true"></i>
                            Kategori</span>
                    </a>

                    <hr>
                    <div class="table-responsive dt-responsive">
                        <div id="dt-ajax-array_wrapper" class="dataTables_wrapper dt-bootstrap4">

                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="tblKategori" class="table table-striped table-bordered nowrap dataTable"
                                        role="grid" aria-describedby="dt-ajax-array_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" width="5%" tabindex="0"
                                                    aria-controls="dt-ajax-array" rowspan="1" colspan="1">No</th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="dt-ajax-array"
                                                    rowspan="1" colspan="1">Kategori</th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="dt-ajax-array"
                                                    rowspan="1" colspan="1">Deskripsi</th>
                                                <th class="sorting_asc" tabindex="0" width="15%"
                                                    aria-controls="dt-ajax-array" rowspan="1" colspan="1">Aksi</th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr class="odd">
                                                <td valign="top" colspan="6" class="dataTables_empty">Loading...</td>
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

        <!-- Zero config table end -->
        <!-- Modal -->
        <div class="modal fade" id="modalAddKategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formAddKategori" method="POST">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Nama Kategori:</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" placeholder="" id="nama_kategori"
                                        name="nama_kategori">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Deskripsi Kategori:</label>
                                <div class="col-lg-6">
                                    <textarea class="form-control" name="deskripsi_kategori" id="deskripsi_kategori" rows="3"></textarea>

                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalEditKategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formEditKategori" method="POST">
                            <input type="hidden" name="id_kategori_edit" id="id_kategori_edit">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Nama Kategori:</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" placeholder="" id="nama_kategori_edit"
                                        name="nama_kategori_edit">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Deskripsi Kategori:</label>
                                <div class="col-lg-6">
                                    <textarea class="form-control" name="deskripsi_kategori_edit" id="deskripsi_kategori_edit" rows="3"></textarea>

                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection



    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#modalAddKategori').on('hidden.bs.modal', function() {
                    // Reset form ketika modal ditutup
                    $("#formAddKategori")[0].reset();

                });

                show()
            });

            function show() {


                $('#tblKategori').DataTable({
                    processing: true,
                    serverSide: true,
                    destroy: true,
                    "ajax": {
                        url: BASE_URL + "/admin/kategori-data",
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
                                return '<div class="text-left">' + data.nama_kategori + '</div>'
                            }
                        },
                        {
                            "orderable": false,
                            "data": function(data) {
                                return '<div class="text-left">' + data.deskripsi + '</div>'
                            }
                        },

                        {
                            "orderable": false,
                            "data": function(data) {
                                return `<div class="text-center">
                                <button type="button" class="btn btn-icon btn-rounded btn-outline-success" onclick="editData(this)" data-id="${data.id}" data-name="${data.nama_kategori}" data-deskripsi="${data.deskripsi}"><i class="fas fa-edit" title="Edit"></i></button>
                                <button type="button" class="btn btn-icon btn-rounded btn-outline-danger" title="Hapus" onclick="deleteData(this)" data-id="${data.id}" data-name="${data.nama_kategori}"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </div>`
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

            $('#formAddKategori').on('submit', function(e) {

                e.preventDefault();
                var postData = new FormData($("#formAddKategori")[0]);
                var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Ambil token CSRF
                postData.append('_token', csrfToken); // Sertakan token CSRF di FormData
                $.ajax({
                    type: "POST",
                    url: BASE_URL + "/admin/kategori-insert",
                    processData: false,
                    contentType: false,
                    data: postData,
                    dataType: "JSON",
                    success: function(data) {
                        if (data.success == false) {
                            // Loop through each error message and display it using the toast
                            data.errors.forEach(function(error) {
                                $.toast({
                                    heading: 'Error',
                                    text: error, // Display the actual error message from server
                                    showHideTransition: 'fade',
                                    icon: 'error',
                                    position: 'top-right' // You can change the position as needed
                                });
                            });
                        } else if (data.success == true) {
                            swal("Berhasil!", "Data telah ditambahkan!", "success");
                            $('#tblKategori').DataTable().ajax.reload(null, false); // Reload the DataTable
                            $("#formAddKategori")[0].reset(); // Reset the form
                            $('#modalAddKategori').modal('hide'); // Hide the modal
                        }
                    },
                });
                return false;
            });

            function deleteData(elem) {
                var id = $(elem).data("id");
                var name = $(elem).data("name");

                var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Ambil token CSRF

                var title = "Hapus ..?"
                var msg = name

                swal({
                        title: title,
                        text: name,
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: BASE_URL + '/admin/kategori-delete/' + id,
                                type: "DELETE",
                                data: {
                                    _token: csrfToken, // Sertakan token CSRF di sini
                                },
                                success: function(data) {


                                    if (data.success == false) {
                                        // Loop through each error message and display it using the toast
                                        swal('Gagal!', data.message, 'error');
                                    } else if (data.success == true) {
                                        swal('Berhasil!', data.message, 'success');
                                        $('#tblKategori').DataTable().ajax.reload(null, false);
                                    }
                                },
                                error: function() {
                                    swal('Gagal!', 'Terjadi Kesalahan', 'error');
                                }
                            });
                        } else {
                            swal("Anda telah membatalkan hapus data", {
                                icon: "error",
                            });
                        }
                    });


            }

            function editData(elem){
                $('#modalEditKategori').modal('show')
                var id = $(elem).data('id')
                var name = $(elem).data('name')
                var deskripsi = $(elem).data('deskripsi')
                

                $('#id_kategori_edit').val(id)
                $('#nama_kategori_edit').val(name)
                $('#deskripsi_kategori_edit').val(deskripsi)
            }

            $('#formEditKategori').on('submit', function(e) {

                e.preventDefault();
                var postData = new FormData($("#formEditKategori")[0]);
                var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Ambil token CSRF
                postData.append('_token', csrfToken); // Sertakan token CSRF di FormData
                $.ajax({
                    type: "POST",
                    url: BASE_URL + "/admin/kategori-update",
                    processData: false,
                    contentType: false,
                    data: postData,
                    dataType: "JSON",
                    success: function(data) {
                        if (data.success == false) {
                            // Loop through each error message and display it using the toast
                            data.errors.forEach(function(error) {
                                $.toast({
                                    heading: 'Error',
                                    text: error, // Display the actual error message from server
                                    showHideTransition: 'fade',
                                    icon: 'error',
                                    position: 'top-right' // You can change the position as needed
                                });
                            });
                        } else if (data.success == true) {
                            swal("Berhasil!", "Data telah ditambahkan!", "success");
                            $('#tblKategori').DataTable().ajax.reload(null, false); // Reload the DataTable
                            $("#formEditKategori")[0].reset(); // Reset the form
                            $('#modalEditKategori').modal('hide'); // Hide the modal
                        }
                    },
                });
                return false;
            });
        </script>
    @endpush
