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
                    <a href="javascript:void(0)" data-bs-target="#modalAddProduk" data-bs-toggle="modal"
                        class="toggle btn btn-primary d-none d-md-inline-flex">
                        <span><i class="fa fa-plus" aria-hidden="true"></i>
                            Produk</span>
                    </a>

                    <hr>
                    <div class="table-responsive dt-responsive">
                        <div id="dt-ajax-array_wrapper" class="dataTables_wrapper dt-bootstrap4">

                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="tblProduk" class="table table-striped table-bordered nowrap dataTable"
                                        role="grid" aria-describedby="dt-ajax-array_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" width="5%" tabindex="0"
                                                    aria-controls="dt-ajax-array" rowspan="1" colspan="1">No</th>
                                                <th class="sorting_asc" width="15%" tabindex="0"
                                                    aria-controls="dt-ajax-array" rowspan="1" colspan="1">Gambar
                                                    Produk</th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="dt-ajax-array"
                                                    rowspan="1" colspan="1">Nama Produk</th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="dt-ajax-array"
                                                    rowspan="1" colspan="1">Kategori</th>
                                                <th class="sorting_asc" tabindex="0" aria-controls="dt-ajax-array"
                                                    rowspan="1" colspan="1">UMKM</th>


                                                <th class="sorting_asc" width="15%" tabindex="0"
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
        <div class="modal fade" id="modalAddProduk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formUAddProduk" method="POST">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Nama Produk</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" placeholder="" id="nama_produk"
                                        name="nama_produk">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Gambar Produk</label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="file" id="img_produk" name="img_produk">
                                    <small class="form-text text-muted">.*.jpg .*png - Maksimal 2 Mb </small><br>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">UMKM</label>
                                <div class="col-lg-6">
                                    <select class="form-control " id="umkm_id" name="umkm_id">
                                        <option value="">Pilih</option>
                                        @foreach ($umkm as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_umkm }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Kategori</label>
                                <div class="col-lg-6">
                                    <select class="form-control" id="kategori_id" name="kategori_id">
                                        <option value="">Pilih</option>
                                        @foreach ($kategori as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Harga</label>
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <div class="input-group-text">Rp.</div>
                                        <input type="text" class="form-control rupiah" placeholder="" id="harga"
                                            name="harga">
                                    </div>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Stok</label>
                                <div class="col-lg-4">
                                    <input type="text" class="form-control int" placeholder="" id="stok"
                                        name="stok">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Status</label>
                                <div class="col-lg-6">
                                    <select class="form-control " id="status_produk" name="status_produk">
                                        <option value="">Pilih</option>
                                        <option value="tersedia">tersedia</option>
                                        <option value="tidak tersedia">tidak tersedia</option>

                                    </select>
                                </div>
                            </div>
                            <label class="col-lg-2 col-form-label">Deskripsi Produk</label>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <div id="quil-deskripsi" style="height: 325px">

                                    </div>
                                </div>
                                <textarea name="deskripsi_produk" id="deskripsi_produk" style="display:none;"></textarea>
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

        <div class="modal fade" id="modalEditProduk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formEditProduk" method="POST">
                            <input type="text" name="id_produk" id="id_produk">
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Nama Produk</label>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" placeholder="" id="nama_produk_edit"
                                        name="nama_produk_edit">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Gambar Produk</label>
                                <div class="col-lg-8">
                                    <input class="form-control" type="file" id="img_produk_edit"
                                        name="img_produk_edit">
                                    <small class="form-text text-muted">.*.jpg .*png - Maksimal 2 Mb </small><br>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">UMKM</label>
                                <div class="col-lg-6">
                                    <select class="form-control " id="umkm_id_edit" name="umkm_id_edit">
                                        <option value="">Pilih</option>
                                        @foreach ($umkm as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_umkm }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Kategori</label>
                                <div class="col-lg-6">
                                    <select class="form-control" id="kategori_id_edit" name="kategori_id_edit">
                                        <option value="">Pilih</option>
                                        @foreach ($kategori as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Harga</label>
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <div class="input-group-text">Rp.</div>
                                        <input type="text" class="form-control rupiah" placeholder="" id="harga_edit"
                                            name="harga_edit">
                                    </div>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Stok</label>
                                <div class="col-lg-4">
                                    <input type="text" class="form-control int" placeholder="" id="stok_edit"
                                        name="stok_edit">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-4 col-form-label">Status</label>
                                <div class="col-lg-6">
                                    <select class="form-control " id="status_produk_edit" name="status_produk_edit">
                                        <option value="">Pilih</option>
                                        <option value="tersedia">tersedia</option>
                                        <option value="tidak tersedia">tidak tersedia</option>

                                    </select>
                                </div>
                            </div>
                            <label class="col-lg-2 col-form-label">Deskripsi Produk</label>
                            <div class="form-group row">
                                <div class="col-lg-12">
                                    <div id="quil-deskripsi-edit" style="height: 325px">

                                    </div>
                                </div>
                                <textarea name="deskripsi_produk_edit" id="deskripsi_produk_edit" style="display:none;"></textarea>
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



                var quill = new Quill('#quil-deskripsi', {
                    modules: {
                        toolbar: [
                            [{
                                header: [1, 2, false]
                            }],
                            ['bold', 'italic', 'underline'],
                            // ['image', 'code-block']
                        ]
                    },
                    placeholder: 'Deskripsikan Produk',
                    theme: 'snow'
                });



                $('#modalAddProduk').on('hide.bs.modal', function() {
                    // Inisiasi ulang Quill setiap kali modal dibuka
                    if (!quill) {
                        quill = new Quill('#quil-deskripsi', {
                            modules: {
                                toolbar: [
                                    [{
                                        header: [1, 2, false]
                                    }],
                                    ['bold', 'italic', 'underline'],
                                    // ['image', 'code-block']
                                ]
                            },
                            placeholder: 'Deskripsikan Produk',
                            theme: 'snow'
                        });
                    }
                });

                $('#modalEditProduk').on('hide.bs.modal', function() {
                    // Inisiasi ulang Quill setiap kali modal dibuka
                    if (!quill) {
                        quill = new Quill('#quil-deskripsi-edit', {
                            modules: {
                                toolbar: [
                                    [{
                                        header: [1, 2, false]
                                    }],
                                    ['bold', 'italic', 'underline'],
                                    // ['image', 'code-block']
                                ]
                            },
                            placeholder: 'Deskripsikan Produk',
                            theme: 'snow'
                        });
                    }
                });
                show()

                $('#formUAddProduk').on('submit', function(e) {


                    var quillContent = quill.root.innerHTML;

                    // Simpan konten Quill ke dalam textarea hidden
                    $('#deskripsi_produk').val(quillContent);
                    e.preventDefault();
                    var postData = new FormData($("#formUAddProduk")[0]);
                    var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Ambil token CSRF
                    postData.append('_token', csrfToken); // Sertakan token CSRF di FormData
                    $.ajax({
                        type: "POST",
                        url: BASE_URL + "/admin/produk-insert-data",
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
                                $('#tblProduk').DataTable().ajax.reload(null,
                                    false); // Reload the DataTable
                                $('#modalAddProduk').modal('hide'); // Hide the modal
                            }
                        },
                    });
                    return false;
                });
            });

            function show() {


                $('#tblProduk').DataTable({
                    processing: true,
                    serverSide: true,
                    destroy: true,
                    "ajax": {
                        url: BASE_URL + "/admin/produk-data",
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
                                    '" height="100px"></div>'
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
                                return '<div class="text-left">' + data.nama_kategori + '</div>'
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
                                return `<div class="text-center">
                                    <button type="button" class="btn btn-icon btn-rounded btn-outline-primary" onclick="editProduk(this)" data-id="${data.id}"  title="Edit"><i class="fa fa-edit" aria-hidden="true" ></i></button>
                                    <a href="{{ url('/') }}/admin/produk-galeri/${data.id}" class="btn btn-icon btn-rounded btn-outline-secondary" title="Galeri" ><i class="feather icon-camera" ></i></a>
                                    <button type="button" onclick="delProduk(this)" data-id="${data.id}" class="btn btn-icon btn-rounded btn-outline-danger" title="Hapus"><i class="fa fa-trash" aria-hidden="true"></i></button>
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



            function delProduk(elem) {
                var id = $(elem).data("id");


                var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Ambil token CSRF

                var title = "Hapus ..?"


                swal({
                        title: title,
                        text: '',
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: BASE_URL + '/admin/produk-delete/' + id,
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
                                        $('#tblProduk').DataTable().ajax.reload(null, false);
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

            function editProduk(elem) {
                var id = $(elem).data("id");
                $.ajax({
                    url: BASE_URL + '/admin/produk-by-id/' + id,
                    type: "GET",
                    success: function(data) {
                        // Cek jika Quill untuk #quil-deskripsi-edit belum diinisiasi, baru inisiasi
                        if (typeof quillEdit === 'undefined') {
                            quillEdit = new Quill('#quil-deskripsi-edit', {
                                modules: {
                                    toolbar: [
                                        [{
                                            header: [1, 2, false]
                                        }],
                                        ['bold', 'italic', 'underline'],
                                        // ['image', 'code-block']
                                    ]
                                },
                                placeholder: 'Deskripsikan Produk',
                                theme: 'snow'
                            });
                        }

                        // Set nilai editor dengan konten deskripsi produk yang didapat dari server
                        quillEdit.root.innerHTML = data.deskripsi || '';

                        // Simpan konten Quill ke dalam textarea hidden
                        $('#deskripsi_produk_edit').val(data.deskripsi);

                        // Menampilkan modal edit produk
                        $('#modalEditProduk').modal('show');

                        // Set nilai field lain di modal edit
                        $('#id_produk').val(id);
                        $('#nama_produk_edit').val(data.nama_produk);
                        $('#umkm_id_edit').val(data.umkm_id);
                        $('#kategori_id_edit').val(data.kategori_id);
                        $('#harga_edit').val(data.harga);
                        $('#stok_edit').val(data.stok);
                        $('#status_produk_edit').val(data.status_produk);
                    },
                    error: function() {
                        swal('Gagal!', 'Terjadi Kesalahan', 'error');
                    }
                });
            }

            $('#formEditProduk').on('submit', function(e) {


                var quillContent = quillEdit.root.innerHTML;

                // Simpan konten Quill ke dalam textarea hidden
                $('#deskripsi_produk_edit').val(quillContent);
                e.preventDefault();
                var postData = new FormData($("#formEditProduk")[0]);
                var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Ambil token CSRF
                postData.append('_token', csrfToken); // Sertakan token CSRF di FormData
                $.ajax({
                    type: "POST",
                    url: BASE_URL + "/admin/produk-update-data",
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
                            $('#tblProduk').DataTable().ajax.reload(null,
                                false); // Reload the DataTable
                            $('#modalEditProduk').modal('hide'); // Hide the modal
                        }
                    },
                });
                return false;
            });
        </script>
    @endpush
