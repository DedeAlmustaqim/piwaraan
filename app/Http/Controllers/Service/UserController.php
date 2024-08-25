<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function getUser($id)
    {
        $data = DB::table('users')->where('id', $id)->first();
        return $data;
    }
}
