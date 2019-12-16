<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Nationality;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Schema;

class NationalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $nationalities = Nationality::all();
        return response()->json(['nationalities' => $nationalities], 200);
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
        $this->authorizeForUser($request->user('api'),'create', Nationality::class);
        return response()->json(['schema' => 'nationalities', 'column' => 'nationality']);
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
        $this->authorizeForUser($request->user('api'),'create', Nationality::class);
        $request->validate([
            'nationality' => 'required'
        ]);

        $nationality = new Country([
            'nationality' => $request->nationality
        ]);

        $nationality->save();

        return response()->json(['message' =>'nationality.creation_success', 'nationality' => $nationality], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Nationality $nationality
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show(Nationality $nationality)
    {
        return response()->json(['nationality' => $nationality]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Nationality $nationality
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function edit(Request $request, Nationality $nationality)
    {
        $this->authorizeForUser($request->user('api'),'create', Nationality::class);
        $columns = Schema::getColumnListing('nationalities');
        return response()->json(['schema' => 'nationalities', 'column' => $columns]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Nationality $nationality
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(Request $request, Nationality $nationality)
    {
        $this->authorizeForUser($request->user('api'),'update', Country::class);
        $request->validate([
            'occupation' => 'required'
        ]);

        $nationality->nationality = $request->nationality;
        $nationality->save();

        return response()->json(['message' => 'nationality.update_success', 'nationality' => $nationality], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Nationality $nationality
     * @return Response
     * @throws AuthorizationException
     */
    public function destroy(Request $request, Nationality $nationality)
    {
        $this->authorizeForUser($request->user('api'),'delete', Nationality::class);

        $nationality->delete();

        return response()->json(['message' => 'nationality.delete_success', 'nationality' => $nationality, 200]);
    }
}
