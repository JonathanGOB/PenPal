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
        return response()->json(['chatrooms' => $chatrooms], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function create(Request $request)
    {
        $this->authorizeForUser($request->user('api'),'create', Chatroom::class);
        $chatroom = new Chatroom();
        $filleables = $chatroom->getFillable();
        $rules = $chatroom->getrules();
        $return_array = array_map(null, $filleables, $rules);
        return response()->json(['schema' => 'chatrooms', 'columns' => $return_array], 200);
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
        return response()->json(['message' => 'chatroom.creation_succes', 'chatroom' => $chatroom], 201);
    }

    public function getNewJoinchat(){
        while(true){
            $joinchat = str_random(60);
            if (Chatroom::where('joinchat', '=', $joinchat)->exists()){
                return $joinchat;
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Chatroom $chatroom
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show(Request $request, Chatroom $chatroom)
    {
        $this->authorizeForUser($request->user('api'),'view', Chatroom::class);
        return response()->json(['chatroom', $chatroom], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Chatroom $chatroom
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function edit(Request $request, Chatroom $chatroom)
    {
        $this->authorizeForUser($request->user('api'),'update', Chatroom::class);
        $fillables = $chatroom->getFillable();
        $rules = $chatroom->getrules();
        $return_array = array_map(null, $fillables, $rules);
        return response()->json(['schema'=>'chatrooms', 'chatroom' => $chatroom, 'columns' => $return_array], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Chatroom $chatroom
     * @return Response
     */
    public function update(Request $request, Chatroom $chatroom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Chatroom $chatroom
     * @return Response
     */
    public function destroy(Chatroom $chatroom)
    {
        //
    }
}
