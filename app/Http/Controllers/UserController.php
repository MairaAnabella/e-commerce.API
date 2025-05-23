<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUser():JsonResponse{
        $user=DB::table('users')
        ->select('*')
        ->get();
        return response()->json($user);
    }
}
