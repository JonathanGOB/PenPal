<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Occupation;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class OccupationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $occupations = Occupation::all();
        return response()->json(["occupations" => $occupations], 201);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function create(Request $request)
    {
        $this->authorizeForUser($request->user('api'),'create', Occupation::class);
        $occupation = new Occupation();
        $fillables = $occupation->getFillable();
        $rules = $occupation->getrules();
        $return_array = array_map(null, $fillables, $rules);
        return response()->json(['schema' => 'occupations', 'columns' => $return_array], 200);
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
     * @param Occupation $occupation
     * @return JsonResponse
     */
    public function show(Occupation $occupation)
    {
        return response()->json(['occupation' => $occupation]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param Occupation $occupation
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function edit(Request $request, Occupation $occupation)
    {
        $this->authorizeForUser($request->user('api'),'create', Occupation::class);
        $fillables = $occupation->getFillable();
        $rules = $occupation->getrules();
        $return_array = array_map(null, $fillables, $rules);
        return response()->json(['schema' => 'occupations', "occupation" => $occupation, 'columns' => $return_array], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Occupation $occupation
     * @return JsonResponse
     * @throws AuthorizationException
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
     * @param Request $request
     * @param Occupation $occupation
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Request $request, Occupation $occupation)
    {
        $this->authorizeForUser($request->user('api'),'delete', Occupation::class);

        $occupation->delete();

        return response()->json(['message' => 'occupation.delete_success', 'occupation' => $occupation], 200);
    }
}
