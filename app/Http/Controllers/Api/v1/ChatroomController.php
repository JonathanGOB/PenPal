<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Chatroom;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
     * @return Response
     * @throws AuthorizationException
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
     * @param Request $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(Request $request)
    {
        $this->authorizeForUser($request->user('api'),'create', Chatroom::class);
        $request->validate([
            'private' => 'required|integer',
            'allow_people_id' => 'required|json',
        ]);

        $roles = array($request->owner_id => "admin") ;
        $invited = json_decode($request->allow_people_id);
        for($i = 0; $i < count($invited); $i++){
            $roles[$invited[$i]] = "normal";
        }

        $roles = json_encode($roles);

        $chatroom = new Chatroom([
            'joinchat' => $this->getNewJoinchat(),
            'private' => $request->private,
            'owner_id' => $request->user(),
            'allow_people_id' => $request->allow_people_id,
            'roles' => $roles
        ]);

        $chatroom->save();
        return response()->json(['message' => 'succes', 'chatroom' => $chatroom], 200);
    }

    public function getNewJoinchat(){
        while(true){
            $joinchat = str_random(60);
            $chat = Chatroom::where('joinchat', '=', $joinchat);
            if ($chat == null){
                return $joinchat;
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chatroom  $chatroom
     * @return Response
     */
    public function show(Chatroom $chatroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chatroom  $chatroom
     * @return Response
     */
    public function edit(Chatroom $chatroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Models\Chatroom  $chatroom
     * @return Response
     */
    public function update(Request $request, Chatroom $chatroom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chatroom  $chatroom
     * @return Response
     */
    public function destroy(Chatroom $chatroom)
    {
        //
    }
}
