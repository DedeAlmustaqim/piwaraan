@extends('layout.app')

@section('content')
    <div class="nk-block nk-block-lg">
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h4 class="nk-block-title">{{ $data['title'] }}</h4>

            </div>
        </div>


        <div class="card card-bordered card-preview">
            <div class="card-inner full-width">
               

                <div class="table-responsive">
                    <table width="100%" class="table wrap table-bordered table-striped" id="TblUser">
                        <thead class="table-light text-center">
                            <tr>

                                <th width="5%">No</th>
                                <th>Nama</th>
                                <th>No HP</th>
                                <th>Stakeholder</th>
                                <th>Status</th>
                             

                                <th width="18%">Aksi</th>
                            </tr>
                        </thead>

                    </table>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="modalStakeholder" tabindex="1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Stakeholder</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form id="formStakeholder" method="POST" class="form-validate is-alter gy-3">

                        <div class="form-group">
                            <label class="form-label" for="nm_terlapor">Stakeholder</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="stak" name="stak" required
                                    data-msg="Isi isian ini">
                            </div>
                        </div>


                        <div class="form-group">
                            <button type="button" data-bs-dismiss="modal" class="btn btn-lg btn-danger ">Batal</button>
                            <button type="submit" class="btn btn-lg btn-primary ">Kirim</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <span class="sub-text">Periksa kembali isian Anda sebelum Kirim</span>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalStakeholderEdit" tabindex="1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Stakeholder</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form id="formEditStakeholder" method="POST" class="form-validate is-alter gy-3">
                        <input type="text" hidden id="id_stak" name="id_stak">
                        <div class="form-group">
                            <label class="form-label" for="nm_terlapor">Stakeholder</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="stakholder_edit" name="stakholder_edit"
                                    required data-msg="Isi isian ini">
                            </div>
                        </div>


                        <div class="form-group">
                            <button type="button" data-bs-dismiss="modal" class="btn btn-lg btn-danger ">Batal</button>
                            <button type="submit" class="btn btn-lg btn-primary ">Kirim</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <span class="sub-text">Periksa kembali isian Anda sebelum Kirim</span>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            showUser()
        });


        function showUser() {
            var userRole = "{{ auth()->user()->role }}"; // Anda bisa mengganti ini dengan cara lain untuk mendapatkan role

            $('#TblUser').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                "bPaginate": true,
                "bLengthChange": true,
                "bFilter": true,
                "bInfo": true,
                "bAutoWidth": false,
                "columnDefs": [{
                    "visible": false,
                }],
                "order": [
                    [0, 'asc']
                ],
                "language": {
                    "lengthMenu": "Tampilkan&nbsp;   _MENU_  &nbsp;item per halaman",
                    "zeroRecords": "Tidak ada data yang ditampilkan",
                    "info": "Menampilkan Halaman _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada data yang ditampilkan",
                    "infoFiltered": "(filtered from _MAX_ total records)",
                    "search": "Cari&nbsp;",
                    "paginate": {
                        "first": "Awal",
                        "last": "Akhir",
                        "next": ">",
                        "previous": "<"
                    },
                },
                "displayLength": 25,
                "ajax": {
                    "url": BASE_URL + "/user/get-users",
                },
                "columns": [{
                        "orderable": false,
                        "data": function(data) {
                            return '<div class="text-left">' + data.id + '</div>'
                        }
                    },
                    {
                        "orderable": false,
                        "data": function(data) {
                            return '<div class="text-left">' + data.name + '</div>'
                        }
                    },
                    {
                        "orderable": false,
                        "data": function(data) {
                            return '<div class="text-left">' + data.no_hp + '</div>'
                        }
                    },
                    {
                        "orderable": false,
                        "data": function(data) {
                            return '<div class="text-left">' + data.stakeholder + '</div>'
                        }
                    },
                    
                    {
                        "orderable": false,
                        "data": function(data) {
                            var active = data.active === 1 ? "<span class='text-success'>Aktif</span>" : "<span class='text-warning'>Tidak Aktif</span>";
                            return '<div class="text-center">' + active + '</div>'
                        }
                    },
                    {

                        "orderable": false,
                        "data": function(data, ) {
                            return '<div class="text-center"><div class="dropdown">' +
                                '<a href="#" class="btn btn-outline-secondary" data-bs-toggle="dropdown" aria-expanded="false"><span>Aksi</span><em class="icon ni ni-chevron-down"></em></a>' +
                                '<div class="dropdown-menu  mt-1" style="">' +
                                '<ul class="link-list-plain">' +
                                '<li><a style="cursor: pointer;" data-id="' + data.id +
                                '" onclick="editStak(this)" data-stak="' + data.stakeholder +
                                '">Edit</a></li>' +
                                '<li><a style="cursor: pointer;" data-id="' + data.id +
                                '" onclick="deleteStak(this)">Hapus</a></li>' +
                                '</ul>' +
                                '</div>' +
                                '</div></div>'
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

        $('#formStakeholder').on('submit', function(e) {
            var postData = new FormData($("#formStakeholder")[0]);
            postData.append('_token', $('meta[name="csrf-token"]').attr(
                'content')); // Tambahkan token CSRF ke FormData
            $.ajax({
                type: "post",
                "url": BASE_URL + "/stakeholder",
                processData: false,
                contentType: false,
                data: postData,
                dataType: "JSON",
                success: function(data) {


                    if (data.success == false) {
                        toastr.clear();
                        Object.keys(data.errors).forEach(function(key) {
                            var error = data.errors[key];
                            NioApp.Toast(
                                '<h5>Gagal Simpan Data</h5><p class="text-danger">' +
                                error + '</p>', 'error');
                        });
                    } else if (data.success == true) {

                        Swal.fire('Simpan Data Berhasil', '', 'success')
                        showStakholder()
                        $("#formStakeholder")[0].reset();
                        $('#modalStakeholder').modal('hide');
                    }

                },

            })
            return false;
        });

        function deleteStak(elem) {
            var id = $(elem).data("id");

            var postData = new FormData($("#formStakeholder")[0]);
            postData.append('_token', $('meta[name="csrf-token"]').attr(
                'content')); // Tambahkan token CSRF ke FormData

            var title = "Hapus Stakeholder..?"
            var msg = "Berhasil Hapus Data"

            Swal.fire({
                title: title,
                text: '',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Ya'
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        url: BASE_URL + '/stakeholder/' + id,
                        type: "DELETE",
                        data: postData,
                        success: function(data) {
                            Swal.fire('Berhasil!', msg, 'success');
                            showStakholder();

                        },
                        error: function() {

                            Swal.fire('Gagal!', 'Terjadi kesalahan .', 'error');
                        }
                    });

                }
            });
        }

        function editStak(elem) {
            var id = $(elem).data("id");
            var stak = $(elem).data("stak");
            $('#modalStakeholderEdit').modal('show')

            $('#id_stak').val(id)
            $('#stakholder_edit').val(stak)
        }

        $('#formEditStakeholder').on('submit', function(e) {
            e.preventDefault(); // Mencegah form dikirimkan secara normal

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var id = $('#id_stak').val();
            var postData = new FormData($("#formEditStakeholder")[0]);

            $.ajax({
                type: "POST",
                url: BASE_URL + "/stakeholder/" + id,
                processData: false,
                contentType: false,
                data: postData,
                dataType: "JSON",
                cache: false,
                success: function(data) {
                    if (data.success == false) {
                        toastr.clear();
                        NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + data
                            .message + '</p>', 'error');
                    } else if (data.success == true) {
                        Swal.fire('Simpan Data Berhasil', '', 'success');
                        showStakholder();
                        $("#formEditStakeholder")[0].reset();
                        $('#modalStakeholderEdit').modal('hide');
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });
    </script>
@endpush
