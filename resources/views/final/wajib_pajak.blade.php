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
                    <table width="100%" class="table wrap table-bordered table-striped" id="TblFinal">
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

    <div class="modal fade" id="modalWajibPajak" tabindex="1">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Data Potensi Wajib Pajak</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body bg-white">
                    
                    <div id="show-data-final"></div>
                    <hr>
                    <h5>Data Survey</h5>
                    
                    <div id="show-data-survey"></div>
                   

                    <div class="card-inner">
                        <div id="gMap" class="card card-bordered google-map w-100"></div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtE5XlnVnfmWO8S7CXyiXYZjIBUM3-37c"></script>
@endpush
