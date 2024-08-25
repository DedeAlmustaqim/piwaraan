@extends('layout_landing.app')

@section('content')
    <style>
        .card-scrollable {
            position: fixed;
            right: 8%;
            top: 15%;
            width: 400px;
            height: 60vh;
            overflow-y: auto;
            z-index: 1000;
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .img-float {
            position: fixed;
            left: 5%;
            bottom: 15%;
            padding: 5px;

            z-index: 1000;
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .h-100vh {
            height: 80vh;
        }
    </style>
    <div class="img-float">

        <img class="" width="250" src="{{ asset('src/images/piwaraan_logo.png') }}"
            srcset="{{ asset('src/images/piwaraan_logo.png') }} 2x" alt="logo">
        <h6 class="text-center">BAPENDA KAB. BARITO TIMUR</h6>
    </div>

    <!-- Card Scrollable -->
    <div class="card card-scrollable">
        <div class="card-header border-bottom">Koordinat MBLB berdasarakan Kecamatan</div>
        <div class="card-inner">
            <div class="form-group">
                <label class="form-label" for="jenis_iup">Pilih Kecamatan</label>
                <div class="form-control-wrap ">
                    <div class="form-control-select">
                        <select class="form-control" id="id_kec_gis" name="id_kec_gis" required data-msg="Isi isian ini">
                            <option value="">Pilih </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="p-3">
                <table class="table">
                    <tbody id="tr-data">
                        <!-- Baris tabel akan diisi dinamis oleh JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- No Header -->


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div id="gMapPiwaraan" class="card card-bordered google-map w-100 h-100vh"></div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtE5XlnVnfmWO8S7CXyiXYZjIBUM3-37c"></script>
    <script>
        var map;
        var markers = [];
        var locations = {}; // Objek global untuk menyimpan lokasi dan marker
        var currentInfoWindow = null; // Variabel global untuk menyimpan infoWindow yang terbuka saat ini

        $(document).ready(function() {
            gisPiwaraan();
            $.ajax({
                url: BASE_URL + '/service/kecamatan',
                dataType: 'json',
                success: function(data) {
                    $.each(data, function(index, item) {
                        $('#id_kec_gis').append('<option value="' + item.id + '">' + item
                            .nm_kec + '</option>');
                    });
                }
            });
        });

        $('#id_kec_gis').change(function() {
            var id = $(this).val();
            $('#tr-data').html('');
            $.ajax({
                url: BASE_URL + '/wajib-pajak-kecamatan/' + id,
                dataType: 'json',
                success: function(data) {
                    var rows = '';
                    $.each(data, function(index, item) {
                        rows += `<tr>
        <td width="75%">` + item.nm_pemegang_izin + `</td>
        <td><button class="btn btn-light" data-lat="` + item.latitude + `" data-lng="` + item.longitude +
                            `" data-id="` + item.id + `">Fokus</button></td>
    </tr>`;
                    });
                    $('#tr-data').html(rows);

                    // Tambahkan event listener untuk tombol "Fokus"
                    $('#tr-data').on('click', '.btn-light', function() {
                        var lat = $(this).data('lat');
                        var lng = $(this).data('lng');
                        var id = $(this).data('id');
                        focusLocation(lat, lng, id);
                    });
                }
            });
        });

        function gisPiwaraan() {
            $.ajax({
                url: BASE_URL + '/wajib-pajak-all/',
                dataType: 'json',
                success: function(data) {
                    var mapOptions = {
                        zoom: 12,
                        center: new google.maps.LatLng(-1.9681303297118853,
                            115.14869787938026), // Koordinat Tamiang Layang
                        mapTypeId: google.maps.MapTypeId.ROADMAP

                    };

                    var mapElement = document.getElementById('gMapPiwaraan');
                    map = new google.maps.Map(mapElement, mapOptions);

                    data.forEach(function(item) {
                        var latitude = parseFloat(item.latitude.toString().replace('−', '-'));
                        var longitude = parseFloat(item.longitude.toString().replace('−', '-'));

                        var marker = new google.maps.Marker({
                            map: map,
                            draggable: true,
                            animation: google.maps.Animation.DROP,
                            position: new google.maps.LatLng(latitude, longitude),
                            icon: {
                                url: BASE_URL + '/src/assets/images/icon_tambang.png',
                                scaledSize: new google.maps.Size(54, 54),
                                labelOrigin: new google.maps.Point(27, 60)
                            },
                            label: {
                                text: item.nm_pemegang_izin,
                                color: 'grey',
                                fontSize: '10px',
                                className: 'card p-1'
                            }
                        });

                        var infoWindow = new google.maps.InfoWindow({
                            content: `
                        <table width="100%" class="table table-borderless">
                            <tr>
                                <td width="35%">Nama Wajib Pajak</td>
                                <td width="2%">:</td>
                                <td class="text-left">${item.nm_wp}</td>
                            </tr>
                            <tr>
                                <td>Alamat Objek Pajak</td>
                                <td>:</td>
                                <td class="text-left">${item.alamat_objek}</td>
                            </tr>
                            <tr>
                                <td>Kecamatan</td>
                                <td>:</td>
                                <td class="text-left">${item.nm_kec}</td>
                            </tr>
                            <tr>
                                <td>Kelurahan/Desa</td>
                                <td>:</td>
                                <td class="text-left">${item.nm_desa}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Survey</td>
                                <td>:</td>
                                <td class="text-left">${item.tgl}</td>
                            </tr>
                            <tr>
                                <td>Foto Potensi</td>
                                <td>:</td>
                                <td class="text-left"><img src="${item.lampiran}" height="200px"></td>
                            </tr>
                        </table>
                        <table width="100%" class="table table-borderless">
                            <tr>
                                <td width="35%">Nama Pemegang Perizinan</td>
                                <td width="2%">:</td>
                                <td class="text-left">${item.nm_pemegang_izin}</td>
                            </tr>
                            <tr>
                                <td>Jenis IUP</td>
                                <td>:</td>
                                <td class="text-left">${item.jenis_iup}</td>
                            </tr>
                            <tr>
                                <td>Tahapan IUP</td>
                                <td>:</td>
                                <td class="text-left">${item.tahapan}</td>
                            </tr>
                            <tr>
                                <td>Kelurahan/Luas</td>
                                <td>:</td>
                                <td class="text-left">${item.luas}</td>
                            </tr>
                            <tr>
                                <td>Komoditas</td>
                                <td>:</td>
                                <td class="text-left">${item.komoditas}</td>
                            </tr>
                            <tr>
                                <td>Nomor Izin</td>
                                <td>:</td>
                                <td class="text-left">${item.no_izin}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Terbit</td>
                                <td>:</td>
                                <td class="text-left">${item.tgl_terbit}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Berakhir</td>
                                <td>:</td>
                                <td class="text-left">${item.tgl_berakhir}</td>
                            </tr>
                            <tr>
                                <td>Kelengkapan Dokumen</td>
                                <td>:</td>
                                <td class="text-left"><a target="_blank" href="${item.file_url}" class="btn btn-secondary" target="_self">Lihat</a></td>
                            </tr>
                        </table>
                    `
                        });

                        locations[item.id] = {
                            marker: marker,
                            latLng: new google.maps.LatLng(latitude, longitude),
                            infoWindow: infoWindow
                        };

                        marker.addListener('click', function() {
                            infoWindow.open(map, marker);
                        });
                    });

                    function focusLocation(lat, lng, id) {
                        var latLng = new google.maps.LatLng(lat, lng);
                        map.setCenter(latLng);
                        map.setZoom(12);

                        // Tutup infoWindow yang terbuka jika ada
                        if (currentInfoWindow) {
                            currentInfoWindow.close();
                        }

                        if (locations[id]) {
                            currentInfoWindow = locations[id].infoWindow;
                            locations[id].infoWindow.open(map, locations[id].marker);
                        }
                    }

                    window.focusLocation = focusLocation;
                }
            });
        }
    </script>
@endpush
