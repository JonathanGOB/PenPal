<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        $tags = Tag::all();
        return response()->json(['tags' => $tags], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Request $request){
        $this->authorizeForUser($request->user('api'),'create', Tag::class);
        return response()->json(['schema' => 'tags', 'columns' => ['tag']], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request){
        $this->authorizeForUser($request->user('api'),'store', Tag::class);
        $request->validate([
            'tag' => 'required'
        ]);

        $tag = new Tag([
            'tag' => $request->tag
        ]);

        $tag->save();

        return response()->json(['message' =>'tag.creation_success', 'tags' => $tag], 201);
    }

    /**
     * @param Tag $tag
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Tag $tag){
        return response()->json(['user' => $tag]);
    }

    /**
     * @param Request $request
     * @param Tag $tag
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Request $request, Tag $tag){
        $this->authorizeForUser($request->user('api'),'create', Tag::class);
        $columns = Schema::getColumnListing('tags');
        return response()->json(['schema' => 'tags', 'columns' => $columns], 200);
    }

    /**
     * @param Request $request
     * @param Tag $tag
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Tag $tag){
        $this->authorizeForUser($request->user('api'),'update', Tag::class);
        $request->validate([
            'tag' => 'required'
        ]);

        $tag->tag = $request->tag;
        $tag->save();

        return response()->json(['message' => 'tag.update_success', 'tag' => $tag], 200);
    }

    /**
     * @param Request $request
     * @param Tag $tag
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete(Request $request, Tag $tag){
        $this->authorizeForUser($request->user('api'),'delete', Tag::class);

        $tag->delete();

        return response()->json(['message' => 'tag.delete_success', 'tagId' => $tag], 200);
    }


}
