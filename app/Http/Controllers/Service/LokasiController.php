<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class LokasiController extends Controller
{
    public function getKecamatanJson(): JsonResponse
    {
        $data = DB::table('kecamatan')->get();

        if ($data->isNotEmpty()) {
            return response()->json($data, Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Not found'], Response::HTTP_NOT_FOUND);
        }
    }
    public function getDesaJson($id): JsonResponse
    {
        $data = DB::table('desa')
            ->where('id_kec', $id)
            ->get();

        if ($data->isNotEmpty()) {
            return response()->json($data, Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Not found'], Response::HTTP_NOT_FOUND);
        }
    }
}
