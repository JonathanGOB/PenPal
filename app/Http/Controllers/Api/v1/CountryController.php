<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Schema;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $countries = Country::all();
        return response()->json(['countries' => $countries], 201);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function create(Request $request)
    {
        $this->authorizeForUser($request->user('api'),'create', Country::class);
        $country = new Country();
        $fillables = $country->getFillable();
        $rules = $country->getrules();
        $return_array = array_map(null, $fillables, $rules);
        return response()->json(['schema' => 'countries', 'columns' => $return_array], 200);
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
        $this->authorizeForUser($request->user('api'),'create', Country::class);
        $request->validate([
            'country' => 'required'
        ]);

        $occupation = new Country([
            'country' => $request->country
        ]);

        $occupation->save();

        return response()->json(['message' =>'country.creation_success', 'country' => $occupation], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Country $country
     * @return JsonResponse
     */
    public function show(Country $country)
    {
        return response()->json(['country' => $country]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Country $country
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function edit(Request $request, Country $country)
    {
        $this->authorizeForUser($request->user('api'),'create', Country::class);
        $fillables = $country->getFillable();
        $rules = $country->getrules();
        $return_array = array_map(null, $fillables, $rules);
        return response()->json(['schema' => 'countries', "country" => $country, 'columns' => $return_array], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Country $country
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function update(Request $request, Country $country)
    {
        $this->authorizeForUser($request->user('api'),'update', Country::class);
        $request->validate([
            'country' => 'required'
        ]);

        $country->country = $request->country;
        $country->save();

        return response()->json(['message' => 'country.update_success', 'occupation' => $country], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Country $country
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Request $request, Country $country)
    {
        $this->authorizeForUser($request->user('api'),'delete', Country::class);

        $country->delete();

        return response()->json(['message' => 'country.delete_success', 'occupation' => $country, 200]);
    }
}
