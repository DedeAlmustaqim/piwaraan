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
                    <table width="100%" class="table wrap table-bordered table-striped" id="TblDataSurvey">
                        <thead class="table-light text-center">
                            <tr>

                                <th width="5%">No</th>
                                <th width="18%">Wajib Pajak</th>
                                <th width="20%">Alamat Objek Pajak</th>
                                <th>Kecamatan</th>
                                <th>Kelurahan</th>

                                <th>Stakeholder</th>
                                <th width="20%">Aksi</th>
                            </tr>
                        </thead>

                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modalSurvey" tabindex="1">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Lengkapi Data Survey</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <h5>Data Potensi Pajak</h5>
                    <hr>
                    <div id="show-potensi"></div>
                    <hr>
                    <h5>Lengkapi Data Survey</h5>

                    <form id="formSurvey" method="POST" class="form-validate is-alter gy-3">
                        @csrf
                        <input type="text" hidden id="id_potensi_survey" name="id_potensi_survey">
                        <div class="form-group">
                            <label class="form-label" for="nm_terlapor">Nama Pemegang Perizinan</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="nm_pemegang_izin" name="nm_pemegang_izin"
                                    required data-msg="Isi isian ini">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label" for="jenis_iup">Jenis IUP</label>
                                    <div class="form-control-wrap ">
                                        <div class="form-control-select">
                                            <select class="form-control" id="jenis_iup" name="jenis_iup" required
                                                data-msg="Isi isian ini">
                                                <option value="">Pilih </option>
                                                <option value="IUP">IUP </option>
                                                <option value="SIPB">SIPB </option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label" for="tahapan">Tahapan IUP</label>
                                    <div class="form-control-wrap ">
                                        <div class="form-control-select">
                                            <select class="form-control" id="tahapan" name="tahapan" required
                                                data-msg="Isi isian ini">
                                                <option value="">Pilih </option>
                                                <option value="Operasi Produksi">Operasi Produksi </option>
                                                <option value="Eksplorasi">Eksplorasi </option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>




                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label" for="luas">Luas</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="luas" name="luas" required
                                            data-msg="Isi isian ini">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label" for="komoditas">Komoditas</label>
                                    <div class="form-control-wrap ">
                                        <div class="form-control-select">
                                            <select name="komoditas" id="komoditas" class="form-control" required
                                                data-msg="Isi isian ini">
                                                <option value="">Pilih</option>
                                                <option value="Pasir Sungai">Pasir Sungai</option>
                                                <option value="Pasir Laut">Pasir Laut</option>
                                                <option value="Pasir Gunung">Pasir Gunung</option>
                                                <option value="Pasir Kuarsa">Pasir Kuarsa</option>
                                                <option value="Batu Kali">Batu Kali</option>
                                                <option value="Batu Kapur">Batu Kapur</option>
                                                <option value="Batu Gamping">Batu Gamping</option>
                                                <option value="Batu Granit">Batu Granit</option>
                                                <option value="Batu Marmer">Batu Marmer</option>
                                                <option value="Batu Silika">Batu Silika</option>
                                                <option value="Tanah Liat">Tanah Liat</option>
                                                <option value="Tanah Merah (Laterit)">Tanah Merah (Laterit)</option>
                                                <option value="Tanah Urug">Tanah Urug</option>
                                                <option value="Kerikil Sungai">Kerikil Sungai</option>
                                                <option value="Kerikil Gunung">Kerikil Gunung</option>
                                                <option value="Gipsum">Gipsum</option>
                                                <option value="Kaolin">Kaolin</option>
                                                <option value="Batu Pualam (Marmer)">Batu Pualam (Marmer)</option>
                                                <option value="Batu Tuff">Batu Tuff</option>
                                                <option value="Asbes">Asbes</option>
                                                <option value="Trass">Trass</option>
                                                <option value="Bentonit">Bentonit</option>
                                                <option value="Fosfat">Fosfat</option>
                                                <option value="Zeolit">Zeolit</option>
                                            </select>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="no_izin">Nomor Izin</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" id="no_izin" name="no_izin" required
                                    data-msg="Isi isian ini">
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label" for="tgl_terbit">Tanggal Terbit</label>
                                    <div class="form-control-wrap">
                                        <input type="date" class="form-control" id="tgl_terbit" name="tgl_terbit"
                                            required data-msg="Isi isian ini">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label" for="tgl_berakhir">Tanggal Berakhir</label>
                                    <div class="form-control-wrap">
                                        <input type="date" class="form-control" id="tgl_berakhir" name="tgl_berakhir"
                                            required data-msg="Isi isian ini">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <h5>Koordinat</h5>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label" for="latitude">Latitude</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="latitude" name="latitude"
                                            required data-msg="Isi isian ini">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label" for="longitude">Longitude</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" id="longitude" name="longitude"
                                            required data-msg="Isi isian ini">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="form-group">
                            <label class="form-label" for="customFileLabel">Dokumen Pelengkap</label>
                            <div class="form-control-wrap">
                                <div class="form-file">
                                    <input type="file" class="form-file-input" id="dok_survey" name="dok_survey"
                                        required data-msg="Isi isian ini">
                                    <label class="form-file-label" for="lampiran">Pilih File</label>
                                </div>
                            </div>
                            <small class="">Ukuran Maksimal 3 Mb, Format JPG/PNG/PDF</small>
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
        

        function showDataSurvey() {
            
            $('#TblDataSurvey').DataTable({
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
                    "url": BASE_URL + "/survey/get_data_survey",
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
                            return '<div class="text-left">' + data.stakeholder + '</div>'
                        }
                    },
                    {

                        "orderable": false,
                        "data": function(data, ) {

                            return `<div class="text-center"><div class="btn-group" aria-label="Basic example">
  <button type="button" class="btn btn-secondary btn-sm" onClick="lengkapiSurvey(this)" data-id="` + data.id +
                                `"  title="Lengkapi Hasil Survey">Lengkapi Data Survey</button></div></div>`
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
