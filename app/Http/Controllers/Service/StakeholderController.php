<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class StakeholderController extends Controller
{
    public function getStakholder(): JsonResponse
    {
        $data = DB::table('tbl_stakeholder')
        ->when(auth()->user()->role === 'stakeholder', function ($query) {
                return $query->where('tbl_stakeholder.id', session('id_stak'));
            })
        ->get();

        if ($data->isNotEmpty()) {
            return response()->json($data, Response::HTTP_OK);
        } else {
            return response()->json(['message' => 'Not found'], Response::HTTP_NOT_FOUND);
        }
    }
}
