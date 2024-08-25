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
                    <table width="100%" class="table wrap table-bordered table-striped" id="TblPotensiPajakValid">
                        <thead class="table-light text-center">
                            <tr>

                                <th width="5%">No</th>
                                <th width="18%">Wajib Pajak</th>
                                <th width="20%">Alamat Objek Pajak</th>
                                <th>Kecamatan</th>
                                <th>Kelurahan</th>
                                <th>Bukti Dukung</th>
                                <th>Stakeholder</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>

                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            showPotensiPajakValid()
        });

        function showPotensiPajakValid() {
            var userRole = "{{ auth()->user()->role }}";
            $('#TblPotensiPajakValid').DataTable({
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
                    "url": BASE_URL + "/pendataan/get_valid",
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
                            return '<div class="text-left">' + data.alamat_objek + '</div>'
                        }
                    },
                    {

                        "orderable": false,
                        "data": function(data, ) {
                            return '<div class="text-center"><span class="badge bg-success">Validasi</span></div>'
                        }
                    },
                    {

                        "orderable": false,
                        "data": function(data, ) {

                            return `<div class="btn-group" aria-label="Basic example">
  <button type="button" class="btn btn-danger btn-sm" onClick="validasiPotensi(this)" data-id="` + data.id +
                                `" data-value="0" title="Batalkan"><em class="icon ni ni-cross-circle-fill"></em>&nbsp;Batalkan</button></div>`
                        }
                    },

                ],
                "columnDefs": [{
                    "targets": 8, // Indeks kolom "Aksi"
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
