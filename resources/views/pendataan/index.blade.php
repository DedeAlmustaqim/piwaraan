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
                <a href="#" class="btn btn-info mb-2" data-bs-toggle="modal" data-bs-target="#modalAddPotensi">+
                    Potensi Pajak</a>
                <hr>

                <div class="table-responsive">
                    <table width="100%" class="table wrap table-bordered table-striped" id="TblPotensiPajak">
                        <thead class="table-light text-center">
                            <tr>

                                <th width="5%">No</th>
                                <th width="18%">Wajib Pajak</th>
                                <th width="20%">Alamat Objek Pajak</th>
                                <th>Kecamatan</th>
                                <th>Kelurahan</th>
                                <th>Bukti Dukung</th>
                                <th>Stakeholder</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                    </table>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="modalAddPotensi" tabindex="1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Potensi Pajak</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form id="formPotensi" method="POST" class="form-validate is-alter gy-3">
                        <div class="form-group">
                            <input type="text" hidden,ivo imid="id_user_potenp8 zb6si" name="id_user_potensi"
                                value="{{ session('id') }}">
                            <label class="form-label" for="id_kec">Stakeholder</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    @if (auth()->user()->isStakeholder())
                                        <select class="form-control" id="id_stak" name="id_stak" required
                                            data-msg="Isi isian ini">


                                        </select>
                                    @endif
                                    @if (auth()->user()->isAdmin())
                                        <select class="form-control" id="id_stak" name="id_stak" required
                                            data-msg="Isi isian ini">
                                            <option value="">Pilih Stakeholder</option>

                                        </select>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="nm_terlapor">Nama Wajib Pajak</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="nm_wp" name="nm_wp" required
                                    data-msg="Isi isian ini">
                            </div>
                        </div>
                        <h5>Subjek Pajak</h5>
                        <hr>
                        <div class="form-group">
                            <label class="form-label" for="alamat">Alamat</label>
                            <div class="form-control-wrap">
                                <textarea class="form-control" id="alamat_objek" name="alamat_objek" required data-msg="Isi isian ini"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="id_kec">Kecamatan</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" id="id_kec" name="id_kec" required
                                        data-msg="Isi isian ini">
                                        <option value="">Pilih Kecamatan</option>

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="id_desa">Desa</label>
                            <div class="form-control-wrap ">
                                <div class="form-control-select">
                                    <select class="form-control" id="id_desa" name="id_desa" required
                                        data-msg="Isi isian ini">
                                        <option value="">Pilih Desa</option>

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="customFileLabel">Foto Potensi Pajak</label>
                            <div class="form-control-wrap">
                                <div class="form-file">
                                    <input type="file" class="form-file-input" id="file_dukung" name="file_dukung"
                                        required data-msg="Isi isian ini">
                                    <label class="form-file-label" for="lampiran">Pilih File</label>
                                </div>
                            </div>
                            <small class="">Ukuran Maksimal 1 Mb, Format JPG/PNG</small>
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
            showPotensiPajak()
        });

        function showPotensiPajak() {
            $(document).ready(function() {
                showDataSurvey()
            })
            var userRole = "{{ auth()->user()->role }}"; // Anda bisa mengganti ini dengan cara lain untuk mendapatkan role

            $('#TblPotensiPajak').DataTable({
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
                    "url": BASE_URL + "/pendataan/get_all",
                    "type": "post",
                    "data": function(d) {
                        d._token = $('meta[name="csrf-token"]').attr('content');
                    }
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
                            return '<div class="text-left">' + data.nm_wp + '</div>'
                        }
                    },
                    {
                        "orderable": false,
                        "data": function(data) {
                            return '<div class="text-left">' + data.alamat_objek + '</div>'
                        }
                    },
                    {
                        "orderable": false,
                        "data": function(data) {
                            return '<div class="text-left">' + data.nm_kec + '</div>'
                        }
                    },
                    {
                        "orderable": false,
                        "data": function(data) {
                            return '<div class="text-left">' + data.nm_desa + '</div>'
                        }
                    },
                    {
                        "orderable": false,
                        "data": function(data) {
                            return '<div class="text-center"><a href="' + data.file_url +
                                '" target="_blank" class="btn btn-secondary">Lihat</a></div>'
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
                        "data": function(data, ) {
                            if (data.validasi == 0) {
                                return '<div class="dropdown">' +
                                    '<a href="#" class="btn btn-outline-secondary" data-bs-toggle="dropdown" aria-expanded="false"><span>Aksi</span><em class="icon ni ni-chevron-down"></em></a>' +
                                    '<div class="dropdown-menu  mt-1" style="">' +
                                    '<ul class="link-list-plain">' +
                                    '<li><a style="cursor: pointer;" data-id="' + data.id +
                                    '" onclick="potensiEdit(this)">Edit</a></li>' +
                                    '<li><a style="cursor: pointer;" data-id="' + data.id +
                                    '" onclick="potensiDel(this)">Hapus</a></li>' +
                                    '</ul>' +
                                    '</div>' +
                                    '</div>'
                            } else if (data.validasi == 1) {
                                return '<div class="text-center"><span class="badge bg-success">Validasi</span></div>'
                            } else if (data.validasi == 2) {
                                return '<div class="text-center"><span class="badge bg-danger">Batal</span></div>'
                            }
                        }
                    },
                ],
                "columnDefs": [{
                    "targets": 7, // Indeks kolom "Aksi"
                    "visible": userRole !==
                        'stakeholder', // Sembunyikan kolom "Aksi" jika role adalah stakeholder
                    "searchable": false
                }],
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
