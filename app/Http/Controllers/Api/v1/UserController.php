<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        $users = User::simplePaginate(10)->each((function($row){
            $row->setHidden(['email', 'email_verified_at', 'role', 'password', 'remember_token']);
        }));
        return response()->json(['users' => $users]);
    }

    /**
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($userId){
        $user = User::where('id', $userId)->first();
        $user = $user->makeHidden(['email', 'email_verified_at', 'role', 'password', 'remember_token']);
        return response()->json(['user' => $user]);
    }

}
