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
                    <a href="javascript:void(0)" data-bs-target="#modalUmkm" data-bs-toggle="modal"
                        class="toggle btn btn-primary d-none d-md-inline-flex">
                        <span><i class="fa fa-plus" aria-hidden="true"></i>
                            UMKM</span>
                    </a>

                    <hr>
                    <div class="table-responsive dt-responsive">
                        <div id="dt-ajax-array_wrapper" class="dataTables_wrapper dt-bootstrap4">

                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="tblUmkm" class="table table-striped table-bordered nowrap dataTable"
                                        role="grid" aria-describedby="dt-ajax-array_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" width="5%" tabindex="0"
                                                    aria-controls="dt-ajax-array" rowspan="1" colspan="1">No</th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="dt-ajax-array"
                                                    rowspan="1" colspan="1">Logo UMKM</th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="dt-ajax-array"
                                                    rowspan="1" colspan="1">Nama UMKM</th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="dt-ajax-array"
                                                    rowspan="1" colspan="1">Nama Pemilik</th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="dt-ajax-array"
                                                    rowspan="1" colspan="1">NO WA</th>

                                                <th class="sorting_asc" tabindex="0" aria-controls="dt-ajax-array"
                                                    rowspan="1" colspan="1">No Izin</th>
                                                <th class="sorting_asc" width="10%" tabindex="0"
                                                    aria-controls="dt-ajax-array" rowspan="1" colspan="1">Aksi</th>

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

        <!-- Zero config table end -->
        <!-- Modal -->
        <div class="modal fade" id="modalUmkm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah UMKM</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formUmkm" method="POST">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Nama UMKM:</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" placeholder="" id="nama_umkm"
                                        name="nama_umkm">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Logo UMKM</label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="file" id="img_umkm" name="img_umkm">
                                    <small class="form-text text-muted">.*.jpg .*png - Maksimal 2 Mb </small><br>
                                    <small class="form-text text-warning">Boleh dikosongkan</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Nama Pemilik</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" placeholder="" id="pemilik"
                                        name="pemilik">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">No WhatsApp</label>
                                <div class="col-lg-4">

                                    <input type="text" class="form-control" id="no_telp" name="no_telp">
                                    <small class="form-text text-muted">Pastikan No WhatsApp Aktif</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">No Izin</label>
                                <div class="col-lg-4">
                                    <input type="text" class="form-control" placeholder="" id="no_ijin"
                                        name="no_ijin">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Alamat</label>
                                <div class="col-lg-8">
                                    <textarea class="form-control" rows="3" id="alamat" name="alamat"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Tentang UMKM</label>
                                <div class="col-lg-8">
                                    <textarea class="form-control" rows="3" id="tentang" name="tentang"></textarea>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Latitude</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" value="-2.072383" placeholder=""
                                        id="lat" name="lat">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Longitude</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" value="115.138658" placeholder=""
                                        id="long" name="long">

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

        {{-- Edit --}}
        <div class="modal fade" id="modalUmkmEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit UMKM</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formUmkmEdit" method="POST">
                            <input type="hidden" name="id_umkm_edit" id="id_umkm_edit">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Nama UMKM:</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" placeholder="" id="nama_umkm_edit"
                                        name="nama_umkm_edit">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Logo UMKM</label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="file" id="img_umkm_edit" name="img_umkm_edit">
                                    <small class="form-text text-muted">.*.jpg .*png - Maksimal 2 Mb </small><br>
                                    <small class="form-text text-warning">Kosongkan jika tidak ingin diganti</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Nama Pemilik</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" placeholder="" id="pemilik_edit"
                                        name="pemilik_edit">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">No WhatsApp</label>
                                <div class="col-lg-4">

                                    <input type="text" class="form-control" id="no_telp_edit" name="no_telp_edit">
                                    <small class="form-text text-muted">Pastikan No WhatsApp Aktif</small>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">No Izin</label>
                                <div class="col-lg-4">
                                    <input type="text" class="form-control" placeholder="" id="no_ijin_edit"
                                        name="no_ijin_edit">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Alamat</label>
                                <div class="col-lg-8">
                                    <textarea class="form-control" rows="3" id="alamat_edit" name="alamat_edit"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Tentang UMKM</label>
                                <div class="col-lg-8">
                                    <textarea class="form-control" rows="3" id="tentang_edit" name="tentang_edit"></textarea>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Latitude</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" placeholder="" id="lat_edit"
                                        name="lat_edit">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Longitude</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" placeholder="" id="long_edit"
                                        name="long_edit">

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

        <div class="modal fade" id="modalViewUmkm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h4>Informasi UMKM</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div id="showUmkm"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection



    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#modalUmkm').on('hidden.bs.modal', function() {
                    // Reset form ketika modal ditutup
                    $("#formUmkm")[0].reset();

                });

                show()
            });

            function show() {


                $('#tblUmkm').DataTable({
                    processing: true,
                    serverSide: true,
                    destroy: true,
                    "ajax": {
                        url: BASE_URL + "/admin/umkm-data",
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
                                return '<div class="text-center"><img src="' + BASE_URL + ' /' + data.img_umkm +
                                    '" height="60px"></div>'
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
                                return '<div class="text-left">' + data.pemilik + '</div>'
                            }
                        },
                        {
                            "orderable": false,
                            "data": function(data) {
                                return '<div class="text-left">' + data.no_telp + '</div>'
                            }
                        },

                        {
                            "orderable": false,
                            "data": function(data) {
                                return '<div class="text-left">' + data.no_ijin + '</div>'
                            }
                        },
                        {
                            "orderable": false,
                            "data": function(data) {
                                return `<div class="text-center"><button type="button" class="btn btn-icon btn-rounded btn-outline-primary" onclick="viewUmkm(this)" data-id="${data.id}"><i class="fas fa-eye"></i></button>
                                <button type="button" class="btn btn-icon btn-rounded btn-outline-success" onclick="editUmkm(this)" data-id="${data.id}"><i class="fas fa-edit    "></i></button>
                                <button type="button" class="btn btn-icon btn-rounded btn-outline-danger" onclick="delUmkm(this)" data-id="${data.id}" data-name="${data.nama_umkm}"><i class="fa fa-trash" aria-hidden="true"></i></button>
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

            $('#formUmkm').on('submit', function(e) {

                e.preventDefault();
                var postData = new FormData($("#formUmkm")[0]);
                var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Ambil token CSRF
                postData.append('_token', csrfToken); // Sertakan token CSRF di FormData
                $.ajax({
                    type: "POST",
                    url: BASE_URL + "/admin/umkm-insert",
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
                            $('#tblUmkm').DataTable().ajax.reload(null, false); // Reload the DataTable
                            $("#formUmkm")[0].reset(); // Reset the form
                            $('#modalUmkm').modal('hide'); // Hide the modal
                        }
                    },
                });
                return false;
            });

            function delUmkm(elem) {
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
                                url: BASE_URL + '/admin/umkm-delete/' + id,
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
                                        $('#tblUmkm').DataTable().ajax.reload(null, false);
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

            function viewUmkm(elem) {
                var id = $(elem).data("id");
                $.ajax({
                    url: BASE_URL + '/admin/umkm-by-id/' + id,
                    type: "GET",
                    success: function(data) {
                        var html = `<div class="card">
                                    <div class="widget-profile-card-3">
                                        <img class="img-fluid img-thumbnail" src="{{ asset('${data.img_umkm}') }}" alt="Profile-user">
                                    </div>
                                    <div class="card-body text-center">
                                        <h3>${data.nama_umkm}</h3>
                                       
                                        <p>${data.tentang}</p>

                                                <button type="button" name="" id="" class="btn btn-primary btn-lg btn-block"><i class="fa fa-shopping-bag" aria-hidden="true"></i> 40 Produk </button>

                                    </div>
                                       
                                    <div class="card-footer bg-inverse">
                                         <div class="row">
                                            <div class="col-4">
                                                <span>Nama Pemilik </span>
                                            </div>
                                            <div class="col-1">
                                                <span>:</span>
                                            </div>
                                            <div class="col-6">
                                                 <span>${data.pemilik}</span>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-4">
                                                <span>Nomor WA </span>
                                            </div>
                                            <div class="col-1">
                                                <span>:</span>
                                            </div>
                                            <div class="col-6">
                                                 <span>${data.no_telp}</span>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-4">
                                                <span>Nomor Izin </span>
                                            </div>
                                            <div class="col-1">
                                                <span>:</span>
                                            </div>
                                            <div class="col-6">
                                                 <span>${data.no_ijin}</span>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-4">
                                                <span>Alamat </span>
                                            </div>
                                            <div class="col-1">
                                                <span>:</span>
                                            </div>
                                            <div class="col-6">
                                                 <span>${data.alamat}</span>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-4">
                                               
                                            </div>
                                            <div class="col-1">
                                                
                                            </div>
                                            <div class="col-6">
                                                 <a name="" id="" class="btn btn-light" 
   href="https://www.google.com/maps/dir/?api=1&destination=${data.lat},${data.long}" 
   target="_blank" role="button">
   <i class="fa fa-map-pin" aria-hidden="true"></i> Lokasi
</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>`;

                        $('#showUmkm').html(html);
                        $('#modalViewUmkm').modal('show');
                    },
                    error: function() {
                        swal('Gagal!', 'Terjadi Kesalahan', 'error');
                    }
                });
            }

            function editUmkm(elem) {
                var id = $(elem).data("id");
                $.ajax({
                    url: BASE_URL + '/admin/umkm-by-id/' + id,
                    type: "GET",
                    success: function(data) {
                     
                      
                        $('#modalUmkmEdit').modal('show')
                        $('#id_umkm_edit').val(id)
                        $('#pemilik_edit').val(data.pemilik)
                        $('#nama_umkm_edit').val(data.nama_umkm)
                        $('#no_telp_edit').val(data.no_telp)
                        $('#no_ijin_edit').val(data.no_ijin)
                        $('#alamat_edit').val(data.alamat)
                        $('#tentang_edit').val(data.tentang)
                        $('#lat_edit').val(data.lat)
                        $('#long_edit').val(data.long)
                        
                    },
                    error: function() {
                        swal('Gagal!', 'Terjadi Kesalahan', 'error');
                    }
                });
            }

            $('#formUmkmEdit').on('submit', function(e) {

                e.preventDefault();
                var postData = new FormData($("#formUmkmEdit")[0]);
                var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Ambil token CSRF
                postData.append('_token', csrfToken); // Sertakan token CSRF di FormData
                $.ajax({
                    type: "POST",
                    url: BASE_URL + "/admin/umkm-update",
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
                            $('#tblUmkm').DataTable().ajax.reload(null, false); // Reload the DataTable
                            $("#formUmkmEdit")[0].reset(); // Reset the form
                            $('#modalUmkmEdit').modal('hide'); // Hide the modal
                        }
                    },
                });
                return false;
            });
        </script>
    @endpush
