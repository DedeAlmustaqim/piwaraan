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
                    <table width="100%" class="table wrap table-bordered table-striped" id="TblJadwal">
                        <thead class="table-light text-center">
                            <tr>

                                <th width="5%">No</th>
                                <th width="18%">Wajib Pajak</th>
                                <th width="20%">Alamat Objek Pajak</th>
                                <th>Kecamatan</th>
                                <th>Kelurahan</th>

                                <th>Stakeholder</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>

                    </table>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="modaljadwalPotensi">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Tetapkan Jadwal Survey</h5>
                </div>
                <div class="modal-body">
                    <form id="formPenetapanJadwal" class="gy-3" method="POST">
                        <input type="text" hidden id="id_potensi_jadwal" name="id_potensi_jadwal">
                        <div class="row g-3 align-center">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-label" for="site-name">Tanggal</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-control-wrap">
                                    <input type="date" name="date_jadwal" id="date_jadwal" class="form-control" id="full-name">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-label" for="site-name">Pukul</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-control-wrap">
                                    <input type="time" name="time_jadwal" id="time_jadwal" class="form-control" id="full-name">
                                </div>
                            </div>

                        </div>

                        <div class="row g-3 align-center">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label class="form-label" for="site-name">Catatan</label>
                                </div>
                            </div>
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <div class="form-control-wrap">
                                        <textarea class="form-control" id="catatan_jadwal" name="catatan_jadwal"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="customFileLabel">Surat Pemberitahuan <small>(Optional)</small></label>
                            <div class="form-control-wrap">
                                <div class="form-file">
                                    <input type="file" class="form-file-input" id="lampiran_jadwal"
                                        name="lampiran_jadwal">
                                    <label class="form-file-label" for="lampiran_jadwal">Pilih File</label>

                                </div>
                            </div>
                            <small class="">Ukuran Maksimal 1 Mb, Format JPG/PNG/PDF</small>
                        </div>
                        <div class="form-group float-end">
                            <button type="submit" class="btn btn-lg btn-primary">Simpan</button>
                            <button type="button" data-bs-dismiss="modal" class="btn btn-lg btn-warning">Batal</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection
