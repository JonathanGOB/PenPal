<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Chatroom;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class ChatroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorizeForUser($request->user('api'),'viewAny', Chatroom::class);
        $chatrooms = Chatroom::all();
        return response()->json(['chatrooms' => $chatrooms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorizeForUser($request->user('api'),'create', Chatroom::class);
        $chatroom = new Chatroom();
        $filleables = $chatroom->getFillable();
        $rules = $chatroom->getrules();
        $return_array = array_map(null, $filleables, $rules);
        return response()->json(['schema' => 'chatrooms', 'columns' => $return_array]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chatroom  $chatroom
     * @return \Illuminate\Http\Response
     */
    public function show(Chatroom $chatroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chatroom  $chatroom
     * @return \Illuminate\Http\Response
     */
    public function edit(Chatroom $chatroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chatroom  $chatroom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chatroom $chatroom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chatroom  $chatroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chatroom $chatroom)
    {
        //
    }
}
