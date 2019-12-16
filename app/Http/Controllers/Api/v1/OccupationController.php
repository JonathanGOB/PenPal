<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Occupation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class OccupationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $occupations = Occupation::all();
        return response()->json(["occupations" => $occupations], 201);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Request $request)
    {
        $this->authorizeForUser($request->user('api'),'create', Occupation::class);
        return response()->json(['schema' => 'occupations', 'columns' => ['occupation']], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request)
    {
        $this->authorizeForUser($request->user('api'),'store', Occupation::class);
        $request->validate([
            'occupation' => 'required'
        ]);

        $occupation = new Occupation([
            'occupation' => $request->occupation
        ]);

        $occupation->save();

        return response()->json(['message' =>'occupation.creation_success', 'occupation' => $occupation], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Occupation  $occupation
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Occupation $occupation)
    {
        return response()->json(['occupation' => $occupation]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Occupation $occupation
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Request $request, Occupation $occupation)
    {
        $this->authorizeForUser($request->user('api'),'create', Occupation::class);
        $columns = Schema::getColumnListing('occupations');
        return response()->json(['schema' => 'occupations', 'columns' => $columns], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Occupation $occupation
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Occupation $occupation)
    {
        $this->authorizeForUser($request->user('api'),'update', Occupation::class);
        $request->validate([
            'occupation' => 'required'
        ]);

        $occupation->occupation = $request->occupation;
        $occupation->save();

        return response()->json(['message' => 'occupation.update_success', 'occupation' => $occupation], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Occupation $occupation
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Request $request, Occupation $occupation)
    {
        $this->authorizeForUser($request->user('api'),'delete', Occupation::class);

        $occupation->delete();

        return response()->json(['message' => 'occupation.delete_success', 'occupation' => $occupation], 200);
    }
}
