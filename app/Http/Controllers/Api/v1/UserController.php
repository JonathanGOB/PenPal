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
        return response()->json(['users' => $users], 200);
    }

    /**
     * @param $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($userId){
        $user = User::where('id', $userId)->first();
        $user = $user->makeHidden(['email', 'email_verified_at', 'role', 'password', 'remember_token']);
        return response()->json(['user' => $user], 200);
    }

    public function edit(Request $request, User $user){

    }

    public function update(Request $request, User $user){

    }

    public function destroy(Request $request, User $user){

    }

}
