<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    public function index(){
        $tags = Tag::all();
        return response()->json(['tags' => $tags], 200);
    }

    public function create(Request $request){
        $this->authorizeForUser($request->user('api'),'create', Tag::class);
        return response()->json(['tags' => ''], 200);
    }

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

    public function show(Tag $tag){
        return response()->json(['user' => $tag]);
    }

    public function edit(Request $request, Tag $tag){
        $this->authorizeForUser($request->user('api'),'update', Tag::class);
        return response()->json(['tags' => ''], 200);
    }

    public function update(Request $request, Tag $tag){
        $this->authorizeForUser($request->user('api'),'update', Tag::class);
        $request->validate([
            'tag' => 'required'
        ]);

        $tag->tag = $request->tag;
        $tag->save();

        return response()->json(['message' => 'tag.update_success', 'tag' => $tag], 200);
    }

    public function delete(Request $request, Tag $tag){
        $this->authorizeForUser($request->user('api'),'delete', Tag::class);

        $tag->delete();

        return response()->json(['message' => 'tag.delete_success', 'tagId' => $tag], 200);
    }


}
