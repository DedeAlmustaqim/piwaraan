<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        /* Mengatur margin halaman PDF */
        @page {
            size: 8.5in 13in;
            /* Ukuran kertas folio */
            margin-top: 0.2in;
            margin-left: 0.5in;
            margin-right: 0.5in;
            margin-bottom: 0.5in;
        }

        /* Global style untuk teks */
        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
            line-height: 1.5;
        }

        /* Teks rata kiri */
        .text-left {
            text-align: left;
        }

        /* Teks rata kanan */
        .text-right {
            text-align: right;
        }

        /* Teks rata tengah */
        .text-center {
            text-align: center;
        }

        /* Teks justify */
        .text-justify {
            text-align: justify;
        }

        h1 {
            font-size: 14pt;
            margin: auto
        }

        h2 {
            font-size: 18pt;
            margin: auto
        }

        h3 {
            font-size: 10pt;
            font-weight: normal;
            margin: auto,
        }
    </style>
</head>

<body>
    <table border="0" width="75%" align="center">
        <tr>
            <td width="10%">
                <img src="{{ asset('src/images/bartim.png') }}" width="80px">
            </td>
            <td class="text-center">
                <h1>PEMERINTAH KABUPATEN BARITO TIMUR</h1>
                <h2>BADAN PENDAPATAN DAERAH</h2>
                <h3> Jl. Baruh Rintis DAM Buya Kode Pos 73611 Tamiang Layang </h3>
            </td>
        </tr>
    </table>
    <hr>

    <h2 class="text-center">{{ $title }}</h2>

    <h1>Data Potensi Pajak</h1>

    <table width="100%" border="0">
        <tr>
            <td width="35%">Nama Wajib Pajak</td>
            <td width="2%">:</td>
            <td class="text-left">{{ $potensi->nm_wp }}</td>
        </tr>
        <tr>
            <td>Alamat Objek Pajak</td>
            <td>:</td>
            <td class="text-left">{{ $potensi->alamat_objek }}</td>
        </tr>
        <tr>
            <td>Kecamatan</td>
            <td>:</td>
            <td class="text-left">{{ $potensi->nm_kec }}</td>
        </tr>
        <tr>
            <td>Kelurahan/Desa</td>
            <td>:</td>
            <td class="text-left">{{ $potensi->nm_desa }}</td>
        </tr>


        <tr>
            <td>Jadwal Survey</td>
            <td>:</td>
            <td class="text-left">{{ $potensi->tgl }} {{ $potensi->jam }}</td>
        </tr>
        <tr>
            <td>Foto Potensi</td>
            <td>:</td>
            <td class="text-left"><img src="{{ $potensi->file_url }}" height="200px"></td>
        </tr>
    </table>

    <h1>Data Survey</h1>

    <table width="100%" border="0">
        <tr>
            <td width="35%">Nama Pemegang Perizinan</td>
            <td width="2%">:</td>
            <td class="text-left">
                ...........................................................................................</td>
        </tr>
        <tr>
            <td width="35%">Jenis IUP</td>
            <td width="2%">:</td>
            <td class="text-left">
                ...........................................................................................</td>
        </tr>
        <tr>
            <td width="35%">Luas (Ha)</td>
            <td width="2%">:</td>
            <td class="text-left">
                ...........................................................................................</td>
        </tr>
        <tr>
            <td width="35%">Tahapan IUP</td>
            <td width="2%">:</td>
            <td class="text-left">
                ...........................................................................................</td>
        </tr>
        <tr>
            <td width="35%">Komoditas</td>
            <td width="2%">:</td>
            <td class="text-left">
                ...........................................................................................</td>
        </tr>
        <tr>
            <td width="35%">Nomor Izin</td>
            <td width="2%">:</td>
            <td class="text-left">
                ...........................................................................................</td>
        </tr>
        <tr>
            <td width="35%">Tgl Terbit Izin</td>
            <td width="2%">:</td>
            <td class="text-left">
                ...........................................................................................</td>
        </tr>
        <tr>
            <td width="35%">Tgl Berakhir Izin</td>
            <td width="2%">:</td>
            <td class="text-left">
                ...........................................................................................</td>
        </tr>
        <tr>
            <td width="35%">Nomor Izin</td>
            <td width="2%">:</td>
            <td class="text-left">
                ...........................................................................................</td>
        </tr>
        <tr>
            <td colspan="3" class="text-center">Koordinat</td>
        </tr>
        <tr>
            <td width="35%">Latitude</td>
            <td width="2%">:</td>
            <td class="text-left">
                ...........................................................................................</td>
        </tr>
        <tr>
            <td width="35%">Longitude</td>
            <td width="2%">:</td>
            <td class="text-left">
                ...........................................................................................</td>
        </tr>
    </table>

    <br><br>
    <table width="100%" align="center">
        <tr>
            <td class="text-center" width="50%">
                Wajib Pajak<br><br><br><br>
                (...............................)
            </td>
            <td class="text-center" width="50%">
                Koordinator Tim Survey<br><br><br><br>
                (...............................)
            </td>
        </tr>
    </table>
</body>

</html>
