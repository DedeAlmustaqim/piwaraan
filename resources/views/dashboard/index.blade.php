@extends('layout.app')

@section('content')
    <style>
        .h-100vh {
            height: 100vh;
            /* Mengisi 100% dari viewport height */
        }
    </style>
    <h2>{{ $data['title'] }}</h2>
    <div class="row">

        <div class="col-8">
            <div class="card">
                <img src="{{ asset('src/images/index_piwaraan.png') }}" class="">


            </div>


        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-inner">
                    <div class="team">

                        <div class="user-card user-card-s2">
                            <img src="{{ asset('src/images/bartim.png') }}" height="100px">
                            <div class="user-info">
                                <h6>{{ session('name') }}</h6>
                                <span class="sub-text">{{ session('role')}}</span>
                            </div>
                        </div>
                        <ul class="team-info">
                            <li><span>Email</span><span>{{ session('email') }}</span></li>

                        </ul>

                    </div><!-- .team -->
                </div><!-- .card-inner -->
            </div>

        </div>

    </div>
@endsection
{{-- @push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtE5XlnVnfmWO8S7CXyiXYZjIBUM3-37c"></script>
    <script>
        
        $(document).ready(function() {
            gisPiwaraan()
        })


        function gisPiwaraan() {
    $.ajax({
        url: BASE_URL + '/wajib-pajak-all/',
        dataType: 'json',
        success: function(data) {
            $('#modalWajibPajak').modal('show');

            // Opsi peta Google Maps
            var mapOptions = {
                zoom: 12, // Atur level zoom awal
                center: new google.maps.LatLng(data[0].latitude, data[0].longitude), // Atur pusat peta pada koordinat data pertama
                mapTypeId: google.maps.MapTypeId.ROADMAP // Mode peta
            };

            // Ambil elemen HTML yang akan berisi peta
            var mapElement = document.getElementById('gMapPiwaraan');

            // Inisialisasi peta Google Maps
            var map = new google.maps.Map(mapElement, mapOptions);

            // Menyimpan marker dan lokasi untuk referensi
            var markers = [];
            var locations = {};

            // Loop untuk menambahkan marker dan membuat HTML untuk setiap item data
            data.forEach(function(item) {
                var latitude = parseFloat(item.latitude.toString().replace('−', '-'));
                var longitude = parseFloat(item.longitude.toString().replace('−', '-'));

                // Tambahkan marker pada peta untuk setiap data
                var marker = new google.maps.Marker({
                    map: map,
                    draggable: true, // Marker bisa diseret
                    animation: google.maps.Animation.DROP, // Animasi saat marker muncul
                    position: new google.maps.LatLng(latitude, longitude), // Atur posisi marker pada koordinat yang diperoleh
                    icon: {
                        url: BASE_URL + '/src/assets/images/icon_tambang.png', // URL ikon
                        scaledSize: new google.maps.Size(54, 54), // Set ukuran ikon
                        labelOrigin: new google.maps.Point(27, 60) // Sesuaikan label
                    },
                    label: {
                        text: item.nm_pemegang_izin, // Teks label
                        color: 'grey', // Warna teks
                        fontSize: '10px', // Ukuran font
                        className: 'card p-1' // Kelas untuk styling
                    }
                });

                // Buat InfoWindow untuk menampilkan informasi saat marker diklik
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
                                <td class="text-left"><a href="${item.file_url}" class="btn btn-secondary" target="_self">Lihat</a></td>
                            </tr>
                        </table>
                    `
                });

                // Simpan marker dan lokasi untuk referensi
                markers.push(marker);
                locations[item.id] = {
                    marker: marker,
                    latLng: new google.maps.LatLng(latitude, longitude),
                    infoWindow: infoWindow
                };

                // Tambahkan event listener pada marker untuk membuka InfoWindow saat marker diklik
                marker.addListener('click', function() {
                    infoWindow.open(map, marker);
                });
            });

            // Fungsi untuk memfokuskan peta pada marker tertentu
            function focusMarker(id) {
                if (locations[id]) {
                    var location = locations[id];
                    map.setCenter(location.latLng);
                    map.setZoom(16); // Atur level zoom sesuai kebutuhan
                    location.infoWindow.open(map, location.marker);
                }
            }

            // Contoh penggunaan fungsi focusMarker
            // Fokus pada marker dengan ID tertentu (misalnya ID 1118)
            // focusMarker(1118); // Hapus atau komentari baris ini jika tidak ingin fokus pada marker tertentu secara default
        }
    });
}

    </script> --}}
{{-- @endpush --}}
