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
                    <table width="100%" class="table wrap table-bordered table-striped" id="TblValidasi">
                        <thead class="table-light text-center">
                            <tr>

                                <th width="5%">No</th>
                                <th width="18%">Wajib Pajak</th>
                                <th width="20%">Alamat Objek Pajak</th>
                                <th>Kecamatan</th>
                                <th>Kelurahan</th>
                                <th>Bukti Dukung</th>
                                <th>Stakeholder</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>

                    </table>
                </div>

            </div>
        </div>
    </div>
    
@endsection
