<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PotensiController extends Controller
{
    public function getPotensi($id): JsonResponse
    {
        $data = DB::table('potensi_pajak')
            ->select(
                'potensi_pajak.id',
                'potensi_pajak.nm_wp',
                'potensi_pajak.alamat_objek',
                'potensi_pajak.id_kec',
                'potensi_pajak.id_desa',
                'potensi_pajak.file_url',
                'potensi_pajak.created_at',
                'potensi_pajak.update_at',
                'potensi_pajak.validasi',
                'potensi_pajak.id_stak',
                'tbl_stakeholder.stakeholder',
                'tbl_stakeholder.created_at as stakeholder_created_at',
                'kecamatan.nm_kec',
                'desa.nm_desa',
                'tbl_jadwal.tgl',
                'tbl_jadwal.jam',

            )
            ->join('kecamatan', 'potensi_pajak.id_kec', '=', 'kecamatan.id')
            ->join('tbl_jadwal', 'potensi_pajak.id', '=', 'tbl_jadwal.id_potensi')
            ->join('desa', 'potensi_pajak.id_desa', '=', 'desa.id')
            ->join('tbl_stakeholder', 'potensi_pajak.id_stak', '=', 'tbl_stakeholder.id')
            ->where('potensi_pajak.id', $id)

            ->first();

        if ($data) {
            return response()->json($data, Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Not found'], Response::HTTP_NOT_FOUND);
        }
    }

    public function getFinalData($id): JsonResponse
    {
        $data = DB::table('potensi_pajak')
            ->select(
                'potensi_pajak.id',
                'potensi_pajak.nm_wp',
                'potensi_pajak.alamat_objek',
                'potensi_pajak.id_kec',
                'potensi_pajak.id_desa',
                'potensi_pajak.file_url as lampiran',
                'potensi_pajak.created_at',
                'potensi_pajak.update_at',
                'potensi_pajak.validasi',
                'potensi_pajak.id_stak',
                'tbl_stakeholder.stakeholder',
                'tbl_stakeholder.created_at as stakeholder_created_at',
                'kecamatan.nm_kec',
                'desa.nm_desa',
                'tbl_jadwal.tgl',
                'tbl_jadwal.jam',
                'data_survey.nm_pemegang_izin',
                'data_survey.jenis_iup',
                'data_survey.tahapan',
                'data_survey.luas',
                'data_survey.komoditas',
                'data_survey.no_izin',
                'data_survey.tgl_terbit',
                'data_survey.tgl_berakhir',
                'data_survey.latitude',
                'data_survey.longitude',
                'data_survey.file_url',

            )
            ->join('kecamatan', 'potensi_pajak.id_kec', '=', 'kecamatan.id')
            ->join('tbl_jadwal', 'potensi_pajak.id', '=', 'tbl_jadwal.id_potensi')
            ->join('desa', 'potensi_pajak.id_desa', '=', 'desa.id')
            ->join('tbl_stakeholder', 'potensi_pajak.id_stak', '=', 'tbl_stakeholder.id')
            ->join('data_survey', 'potensi_pajak.id', '=', 'data_survey.id_potensi_pajak')
            ->where('potensi_pajak.id', $id)

            ->first();

        if ($data) {
            return response()->json($data, Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Not found'], Response::HTTP_NOT_FOUND);
        }
    }

    public function getAllFinalData(): JsonResponse
    {
        $data = DB::table('potensi_pajak')
            ->select(
                'potensi_pajak.id',
                'potensi_pajak.nm_wp',
                'potensi_pajak.alamat_objek',
                'potensi_pajak.id_kec',
                'potensi_pajak.id_desa',
                'potensi_pajak.file_url as lampiran',
                'potensi_pajak.created_at',
                'potensi_pajak.update_at',
                'potensi_pajak.validasi',
                'potensi_pajak.id_stak',
                'tbl_stakeholder.stakeholder',
                'tbl_stakeholder.created_at as stakeholder_created_at',
                'kecamatan.nm_kec',
                'desa.nm_desa',
                'tbl_jadwal.tgl',
                'tbl_jadwal.jam',
                'data_survey.nm_pemegang_izin',
                'data_survey.jenis_iup',
                'data_survey.tahapan',
                'data_survey.luas',
                'data_survey.komoditas',
                'data_survey.no_izin',
                'data_survey.tgl_terbit',
                'data_survey.tgl_berakhir',
                'data_survey.latitude',
                'data_survey.longitude',
                'data_survey.file_url',

            )
            ->join('kecamatan', 'potensi_pajak.id_kec', '=', 'kecamatan.id')
            ->join('tbl_jadwal', 'potensi_pajak.id', '=', 'tbl_jadwal.id_potensi')
            ->join('desa', 'potensi_pajak.id_desa', '=', 'desa.id')
            ->join('tbl_stakeholder', 'potensi_pajak.id_stak', '=', 'tbl_stakeholder.id')
            ->join('data_survey', 'potensi_pajak.id', '=', 'data_survey.id_potensi_pajak')


            ->get();

        if ($data) {
            return response()->json($data, Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Not found'], Response::HTTP_NOT_FOUND);
        }
    }
    public function getKecamatanFinalData($id): JsonResponse
    {
        $data = DB::table('potensi_pajak')
            ->select(
                'potensi_pajak.id',
                'potensi_pajak.nm_wp',
                'potensi_pajak.alamat_objek',
                'potensi_pajak.id_kec',
                'potensi_pajak.id_desa',
                'potensi_pajak.file_url as lampiran',
                'potensi_pajak.created_at',
                'potensi_pajak.update_at',
                'potensi_pajak.validasi',
                'potensi_pajak.id_stak',
                'tbl_stakeholder.stakeholder',
                'tbl_stakeholder.created_at as stakeholder_created_at',
                'kecamatan.nm_kec',
                'desa.nm_desa',
                'tbl_jadwal.tgl',
                'tbl_jadwal.jam',
                'data_survey.nm_pemegang_izin',
                'data_survey.jenis_iup',
                'data_survey.tahapan',
                'data_survey.luas',
                'data_survey.komoditas',
                'data_survey.no_izin',
                'data_survey.tgl_terbit',
                'data_survey.tgl_berakhir',
                'data_survey.latitude',
                'data_survey.longitude',
                'data_survey.file_url',

            )
            ->where('potensi_pajak.id_kec', $id)
            ->join('kecamatan', 'potensi_pajak.id_kec', '=', 'kecamatan.id')
            ->join('tbl_jadwal', 'potensi_pajak.id', '=', 'tbl_jadwal.id_potensi')
            ->join('desa', 'potensi_pajak.id_desa', '=', 'desa.id')
            ->join('tbl_stakeholder', 'potensi_pajak.id_stak', '=', 'tbl_stakeholder.id')
            ->join('data_survey', 'potensi_pajak.id', '=', 'data_survey.id_potensi_pajak')


            ->get();

        if ($data) {
            return response()->json($data, Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Not found'], Response::HTTP_NOT_FOUND);
        }
    }
}
