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
                    <table width="100%" class="table wrap table-bordered table-striped" id="TblTerjadwal">
                        <thead class="table-light text-center">
                            <tr>

                                <th width="5%">No</th>
                                <th width="18%">Wajib Pajak</th>

                                <th>Jadwal</th>
                                <th>Catatan</th>

                                <th>Stakeholder</th>
                                <th>Surat Pemberitahuan</th>
                                <th width="10%">Aksi</th>
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
            showTerjadwal()
        })

        function showTerjadwal() {
            var userRole = "{{ auth()->user()->role }}"; // Anda bisa mengganti ini dengan cara lain untuk mendapatkan role

            $('#TblTerjadwal').DataTable({
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
                    "url": BASE_URL + "/survey/get_terjadwal",
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
                            return '<div class="text-center"><small>' + data.tgl + '<br> ' + data.jam +
                                '</small></div>'
                        }
                    },
                    {
                        "orderable": false,
                        "data": function(data) {
                            return '<div class="text-left">' + data.catatan + '</div>'
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
                            if (data.file_path == null) {
                                return '<div class="text-center">Tidak ada surat</div>'
                            } else {
                                return '<div class="text-center"><a href="' + data.file_path +
                                    '" target="_blank" class="btn btn-sm btn-secondary">Lihat</a></div>'
                            }

                        }
                    },
                    {

                        "orderable": false,
                        "data": function(data, ) {

                            return '<div class="dropdown">' +
                                '<a href="#" class="btn btn-outline-secondary" data-bs-toggle="dropdown" aria-expanded="false"><span>Aksi</span><em class="icon ni ni-chevron-down"></em></a>' +
                                '<div class="dropdown-menu  mt-1" style="">' +
                                '<ul class="link-list-plain">' +
                                '<li><a style="cursor: pointer;"  href="' + BASE_URL +
                                '/survey/lembar_survey/' + data.id +
                                '" target="_blank">Lembar Survey</a></li>' +
                                '<li><a style="cursor: pointer;" data-id="' + data.id +
                                '" onclick="finishSurvey(this)">Selesai</a></li>' +
                                '</ul>' +
                                '</div>' +
                                '</div>'
                        }
                    },
                ],
                "columnDefs": [{
                    "targets": 6, // Indeks kolom "Aksi"
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
