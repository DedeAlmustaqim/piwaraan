$(document).ready(function () {
    $.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
        return {
            "iStart": oSettings._iDisplayStart,
            "iEnd": oSettings.fnDisplayEnd(),
            "iLength": oSettings._iDisplayLength,
            "iTotal": oSettings.fnRecordsTotal(),
            "iFilteredTotal": oSettings.fnRecordsDisplay(),
            "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
            "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
    };



    showValidasi()
    showJadwal()


    showFinal()
    $.ajax({
        url: BASE_URL + '/service/kecamatan',
        dataType: 'json',
        success: function (data) {
            $.each(data, function (index, item) {
                $('#id_kec').append('<option value="' + item.id + '">' + item.nm_kec + '</option>');
            });
        }
    });
    $.ajax({
        url: BASE_URL + '/service/stakeholder',
        dataType: 'json',
        success: function (data) {
            $.each(data, function (index, item) {
                $('#id_stak').append('<option value="' + item.id + '">' + item.stakeholder + '</option>');
            });
        }
    });
    $('#id_kec').change(function () {
        var id = $(this).val();
        // Menghapus opsi yang ada dalam dropdown 'desa'
        $('#id_desa').empty();

        // Menambahkan opsi default kembali ke dropdown 'desa'
        $('#id_desa').append('<option value="">Pilih Desa</option>');
        $.ajax({
            url: BASE_URL + '/service/desa/' + id,
            dataType: 'json',
            success: function (data) {
                $.each(data, function (index, item) {
                    $('#id_desa').append('<option value="' + item.id + '">' + item.nm_desa + '</option>');
                });
            }
        });

    });
})







$('#formPotensi').on('submit', function (e) {
    e.preventDefault();
    var postData = new FormData($("#formPotensi")[0]);

    $.ajax({
        type: "post",
        url: BASE_URL + "/api/pendataan", // Pastikan BASE_URL diatur dengan benar
        processData: false,
        contentType: false,
        data: postData,
        dataType: "JSON",
        success: function (data) {
            if (data.success == false) {
                toastr.clear();
                data.errors.forEach(function (error) {
                    // Swal.fire('Gagal', error.message, 'warning');
                    NioApp.Toast('<h5>Gagal Simpan Data</h5><p class="text-danger">' + error.message + '</p>', 'error');
                });
            } else if (data.success == true) {
                Swal.fire('Berhasil', 'Laporan telah diteruskan', 'success');
                showPotensiPajak()
                $("#formPotensi")[0].reset();
                $('#modalAddPotensi').modal('hide');
            }
        },

    });
    return false;
});

function showValidasi() {
    $('#TblValidasi').DataTable({
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
            "url": BASE_URL + "/validasi/get_all",
        },
        "columns": [
            {
                "orderable": false,
                "data": function (data) {
                    return '<div class="text-left">' + data.id + '</div>'
                }
            },
            {
                "orderable": false,
                "data": function (data) {
                    return '<div class="text-left">' + data.nm_wp + '</div>'
                }
            },
            {
                "orderable": false,
                "data": function (data) {
                    return '<div class="text-left">' + data.alamat_objek + '</div>'
                }
            },
            {
                "orderable": false,
                "data": function (data) {
                    return '<div class="text-left">' + data.nm_kec + '</div>'
                }
            },
            {
                "orderable": false,
                "data": function (data) {
                    return '<div class="text-left">' + data.nm_desa + '</div>'
                }
            },
            {
                "orderable": false,
                "data": function (data) {
                    return '<div class="text-center"><a href="' + data.file_url + '" target="_blank" class="btn btn-secondary">Lihat</a></div>'
                }
            },
            {
                "orderable": false,
                "data": function (data) {
                    return '<div class="text-left">' + data.stakeholder + '</div>'
                }
            },
            {

                "orderable": false,
                "data": function (data,) {

                    return `<div class="btn-group" aria-label="Basic example">
  <button type="button" class="btn btn-success" onClick="validasiPotensi(this)" data-id="`+ data.id + `" data-value="1" title="Validasi" ><em class="icon ni ni-check-circle"></em></button>
  <button type="button" class="btn btn-danger" onClick="validasiPotensi(this)" data-id="`+ data.id + `" data-value="2" title="Reject"><em class="icon ni ni-cross-circle-fill"></em></button></div>`
                }
            },
        ],
        rowCallback: function (row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $('td:eq(0)', row).html(index);
        },
    });
}


function showJadwal() {
    $('#TblJadwal').DataTable({
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
            "url": BASE_URL + "/survey/getjadwal",
        },
        "columns": [
            {
                "orderable": false,
                "data": function (data) {
                    return '<div class="text-left">' + data.id + '</div>'
                }
            },
            {
                "orderable": false,
                "data": function (data) {
                    return '<div class="text-left">' + data.nm_wp + '</div>'
                }
            },
            {
                "orderable": false,
                "data": function (data) {
                    return '<div class="text-left">' + data.alamat_objek + '</div>'
                }
            },
            {
                "orderable": false,
                "data": function (data) {
                    return '<div class="text-left">' + data.nm_kec + '</div>'
                }
            },
            {
                "orderable": false,
                "data": function (data) {
                    return '<div class="text-left">' + data.nm_desa + '</div>'
                }
            },

            {
                "orderable": false,
                "data": function (data) {
                    return '<div class="text-left">' + data.stakeholder + '</div>'
                }
            },
            {

                "orderable": false,
                "data": function (data,) {

                    return `<div class="btn-group" aria-label="Basic example">
  <button type="button" class="btn btn-success" onClick="jadwalPotensi(this)" data-id="`+ data.id + `" data-value="2" title="Jadwalkan">Jadwalkan</button></div>`
                }
            },
        ],
        rowCallback: function (row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $('td:eq(0)', row).html(index);
        },
    });
}



function validasiPotensi(elem) {
    var id = $(elem).data("id");
    var validasi = $(elem).data("value");
    var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Ambil token CSRF

    if (validasi == 1) {
        var title = 'Verifikasi'
        var text = 'Verifikasi Potensi Pajak ini..?'
        var icon = 'success'
        var msg = 'Data diverifikasi'
    } else if (validasi == 2) {
        var title = 'Tolak'
        var text = 'Tolak Potensi Pajak ini..?'
        var icon = 'warning'
        var msg = 'Data ditolak'
    } else if (validasi == 0) {
        var title = 'Batalkan'
        var text = ''
        var icon = 'warning'
    }
    Swal.fire({
        title: title,
        text: text,
        icon: icon,
        showCancelButton: true,
        confirmButtonText: 'Ya'
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: BASE_URL + '/validasi/' + id,
                type: "POST",
                data: {
                    _token: csrfToken, // Sertakan token CSRF di sini
                    validasi: validasi
                },
                success: function (data) {
                    Swal.fire(title, msg, 'success');
                    showValidasi();
                    showPotensiPajakValid()
                    showPotensiPajakReject()
                },
                error: function () {

                    Swal.fire('Gagal!', 'Terjadi kesalahan .', 'error');
                }
            });

        }
    });
}

function jadwalPotensi(elem) {
    $('#modaljadwalPotensi').modal('show');
    var id = $(elem).data("id");
    $('#id_potensi_jadwal').val(id);
}
function jadwalPotensiReschedule(elem) {
    $('#modaljadwalPotensiReschedule').modal('show');
    var id = $(elem).data("id");
    $('#id_potensi_jadwal').val(id);
}

$('#formPenetapanJadwal').on('submit', function (e) {
    e.preventDefault();
    var postData = new FormData($("#formPenetapanJadwal")[0]);
    postData.append('_token', $('meta[name="csrf-token"]').attr('content')); // Tambahkan token CSRF ke FormData
    $.ajax({
        type: "post",
        url: BASE_URL + "/survey/penetapan_jadwal", // Pastikan BASE_URL diatur dengan benar
        processData: false,
        contentType: false,
        data: postData,
        dataType: "JSON",
        success: function (data) {
            if (data.success == false) {
                toastr.clear();

            } else if (data.success == true) {
                Swal.fire('Berhasil', 'Jadwal Survey telah ditentukan', 'success');

                $("#formPenetapanJadwal")[0].reset();
                $('#modaljadwalPotensi').modal('hide');
                showJadwal()
            }
        },

    });
    return false;
});



function finishSurvey(elem) {
    var id = $(elem).data("id");

    var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Ambil token CSRF

    var title = "Tetapkan Survey Telah Selesai..?"
    var msg = "Survey telah selesai"

    Swal.fire({
        title: title,
        text: '',
        icon: 'info',
        showCancelButton: true,
        confirmButtonText: 'Ya'
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                url: BASE_URL + '/survey/finish_survey/' + id,
                type: "POST",
                data: {
                    _token: csrfToken, // Sertakan token CSRF di sini
                },
                success: function (data) {
                    Swal.fire('Berhasil!', msg, 'success');
                    showTerjadwal();

                },
                error: function () {

                    Swal.fire('Gagal!', 'Terjadi kesalahan .', 'error');
                }
            });

        }
    });
}



function lengkapiSurvey(elem) {
    var id = $(elem).data("id");

    $.ajax({
        url: BASE_URL + '/potensi-pajak/' + id,
        dataType: 'json',
        success: function (data) {
            $('#modalSurvey').modal('show');
            $('#id_potensi_survey').val(id)

            var html = `<table width="100%" class="table table-borderless">
                        <tr>
                            <td width="35%">Nama Wajib Pajak</td>
                            <td width="2%">:</td>
                            <td class="text-left">`+ data.nm_wp + `</td>
                        </tr>
                        <tr>
                            <td>Alamat Objek Pajak</td>
                            <td>:</td>
                            <td class="text-left">`+ data.alamat_objek + `</td>
                        </tr>
                        <tr>
                            <td>Kecamatan</td>
                            <td>:</td>
                            <td class="text-left">`+ data.nm_kec + `</td>
                        </tr>
                        <tr>
                            <td>Kelurahan/Desa</td>
                            <td>:</td>
                            <td class="text-left">`+ data.nm_desa + `</td>
                        </tr>


                        <tr>
                            <td>Tanggal Survey</td>
                            <td>:</td>
                            <td class="text-left">`+ data.tgl + `</td>
                        </tr>
                        <tr>
                            <td>Foto Potensi</td>
                            <td>:</td>
                            <td class="text-left"><img src="`+ data.file_url + `" height="200px"></td>
                        </tr>
                    </table>`


            document.getElementById('show-potensi').innerHTML = html
        }
    });

}

$('#formSurvey').on('submit', function (e) {
    e.preventDefault();

    var postData = new FormData($("#formSurvey")[0]);
    postData.append('_token', $('meta[name="csrf-token"]').attr('content')); // Tambahkan token CSRF ke FormData

    $.ajax({
        type: "post",
        url: BASE_URL + "/survey/store",
        processData: false,
        contentType: false,
        data: postData,
        dataType: "JSON",
        success: function (data) {
            if (data.success == false) {
                data.errors.forEach(function (error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Kesalahan',
                        text: error.message,
                    });
                });
            } else if (data.success == true) {
                Swal.fire('Berhasil', 'Data Survey telah dilengkapi', 'success');
                showPotensiPajak();
                $("#formSurvey")[0].reset();
                $('#modalSurvey').modal('hide');
                showDataSurvey();
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // Tampilkan pesan error jika terjadi masalah CSRF
            Swal.fire({
                icon: 'error',
                title: 'Kesalahan',
                text: 'Token CSRF tidak cocok atau kedaluwarsa. Silakan muat ulang halaman dan coba lagi.',
            });
        }
    });

    return false;
});

function showFinal() {
    $('#TblFinal').DataTable({
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
            "url": BASE_URL + "/final/get_final",
        },
        "columns": [
            {
                "orderable": false,
                "data": function (data) {
                    return '<div class="text-left">' + data.id + '</div>'
                }
            },
            {
                "orderable": false,
                "data": function (data) {
                    return '<div class="text-left">' + data.nm_wp + '</div>'
                }
            },
            {
                "orderable": false,
                "data": function (data) {
                    return '<div class="text-left">' + data.alamat_objek + '</div>'
                }
            },
            {
                "orderable": false,
                "data": function (data) {
                    return '<div class="text-left">' + data.nm_kec + '</div>'
                }
            },
            {
                "orderable": false,
                "data": function (data) {
                    return '<div class="text-left">' + data.nm_desa + '</div>'
                }
            },

            {
                "orderable": false,
                "data": function (data) {
                    return '<div class="text-left">' + data.stakeholder + '</div>'
                }
            },
            {

                "orderable": false,
                "data": function (data,) {

                    return `<div class="text-center"><div class="btn-group" aria-label="Basic example">
  <button type="button" class="btn btn-success" onClick="showDataFinal(this)" data-id="`+ data.id + `" data-value="2" title="Jadwalkan">Lihat Data</button></div></div>`
                }
            },
        ],
        rowCallback: function (row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $('td:eq(0)', row).html(index);
        },
    });
}

function showDataFinal(elem) {
    var id = $(elem).data("id");

    $.ajax({
        url: BASE_URL + '/wajib-pajak/' + id,
        dataType: 'json',
        success: function (data) {
            $('#modalWajibPajak').modal('show');
            var html = `<table width="100%" class="table table-borderless">
                        <tr>
                            <td width="35%">Nama Wajib Pajak</td>
                            <td width="2%">:</td>
                            <td class="text-left">`+ data.nm_wp + `</td>
                        </tr>
                        <tr>
                            <td>Alamat Objek Pajak</td>
                            <td>:</td>
                            <td class="text-left">`+ data.alamat_objek + `</td>
                        </tr>
                        <tr>
                            <td>Kecamatan</td>
                            <td>:</td>
                            <td class="text-left">`+ data.nm_kec + `</td>
                        </tr>
                        <tr>
                            <td>Kelurahan/Desa</td>
                            <td>:</td>
                            <td class="text-left">`+ data.nm_desa + `</td>
                        </tr>


                        <tr>
                            <td>Tanggal Survey</td>
                            <td>:</td>
                            <td class="text-left">`+ data.tgl + `</td>
                        </tr>
                        <tr>
                            <td>Foto Potensi</td>
                            <td>:</td>
                            <td class="text-left"><img src="`+ data.lampiran + `" height="200px"></td>
                        </tr>
                    </table>`
            var htmlSurvey = `<table width="100%" class="table table-borderless">
                        <tr>
                            <td width="35%">Nama Pemegang Perizinan</td>
                            <td width="2%">:</td>
                            <td class="text-left">`+ data.nm_pemegang_izin + `</td>
                        </tr>
                        <tr>
                            <td>Jenis IUP</td>
                            <td>:</td>
                            <td class="text-left">`+ data.jenis_iup + `</td>
                        </tr>
                        <tr>
                            <td>Tahapan IUP</td>
                            <td>:</td>
                            <td class="text-left">`+ data.tahapan + `</td>
                        </tr>
                        <tr>
                            <td>Kelurahan/Luas</td>
                            <td>:</td>
                            <td class="text-left">`+ data.luas + `</td>
                        </tr>


                        <tr>
                            <td>Komoditas</td>
                            <td>:</td>
                            <td class="text-left">`+ data.komoditas + `</td>
                        </tr>
                        <tr>
                            <td>Nomor Izin</td>
                            <td>:</td>
                            <td class="text-left">`+ data.no_izin + `</td>
                        </tr>
                        <tr>
                            <td>Tanggal Terbit</td>
                            <td>:</td>
                            <td class="text-left">`+ data.tgl_terbit + `</td>
                        </tr>
                        <tr>
                            <td>Tanggal Berakhir</td>
                            <td>:</td>
                            <td class="text-left">`+ data.tgl_berakhir + `</td>
                        </tr>
                        <tr>
                            <td>Kelengkapan Dokumen</td>
                            <td>:</td>
                            <td class="text-left"><a target="_blank" href="`+ data.file_url + `" class="btn btn-secondary" target="_self" >Lihat </a></td>
                        

                    </table>`

            // Mengatasi masalah karakter negatif khusus pada koordinat
            // Mengatasi masalah karakter negatif khusus pada koordinat
            var latitude = parseFloat(data.latitude.toString().replace('−', '-'));
            var longitude = parseFloat(data.longitude.toString().replace('−', '-'));

            // Opsi peta Google Maps
            var mapOptions = {
                zoom: 14, // Atur level zoom awal
                center: new google.maps.LatLng(latitude, longitude), // Atur pusat peta pada koordinat yang diperoleh
                mapTypeId: google.maps.MapTypeId.Map // Mode peta satelit
            };

            // Ambil elemen HTML yang akan berisi peta
            var mapElement = document.getElementById('gMap');

            // Inisialisasi peta Google Maps
            var map = new google.maps.Map(mapElement, mapOptions);

            // Tambahkan marker pada peta
            var marker = new google.maps.Marker({
                map: map,
                draggable: true, // Marker bisa diseret
                animation: google.maps.Animation.DROP, // Animasi saat marker muncul
                position: new google.maps.LatLng(latitude, longitude), // Atur posisi marker pada koordinat yang diperoleh
                icon: {
                    url: BASE_URL + '/src/assets/images/icon_tambang.png', // null = ikon default
                    scaledSize: new google.maps.Size(54, 54), // Set the icon size to 32px by 32px
                    labelOrigin: new google.maps.Point(120, 27) // Adjust the label's origin to the right of the icon

                },
                label: {
                    text: data.nm_pemegang_izin, // Teks label
                    color: 'grey', // Warna teks
                    fontSize: '14px', // Ukuran font
                    fontWeight: 'bold' // Berat font
                }
            });

            // Buat InfoWindow untuk menampilkan informasi saat marker diklik
            var infoWindow = new google.maps.InfoWindow({
                // content: '<div style="text-align: center;"><p>' + data.nm_wp + '</p><img height="200px" src="' + data.lampiran + '" height="100px"></div>'
                content: html + htmlSurvey
            });

            // Tambahkan event listener pada marker untuk membuka InfoWindow saat marker diklik
            marker.addListener('click', function () {
                infoWindow.open(map, marker);
            });









            document.getElementById('show-data-final').innerHTML = html
            document.getElementById('show-data-survey').innerHTML = htmlSurvey
        }
    });

}

