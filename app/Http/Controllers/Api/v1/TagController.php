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
        return response()->json(['tags' => $tags]);
    }

    public function create(Request $request){
        abort_unless(Gate::before('create', $request->user()));
        return response()->json(['tags' => '']);
    }

    public function post(Request $request){
        abort_unless(Gate::before('create', $request->user()));
        $request->validate([
            'tag' => 'required'
        ]);

        $tag = new Tag([
            'tag' => $request->tag
        ]);

        $tag->save();

        return response()->json(['message' =>'tag.creation_success', 'tags' => $tag], 201);
    }

    public function show($tagId){
        $tag = Tag::where('id', $tagId)->first();
        return response()->json(['user' => $tag]);
    }

    public function edit(Request $request, $tagId){
        abort_unless(Gate::before('update', $request->user()));
        $request->validate([
            'tag' => 'required'
        ]);

        $tag = Tag::where('id', $tagId)->first();
        $tag->tag = $request->tag;
        $tag->save();

        return response()->json(['message' => 'tag.edit_success', 'tag' => $tag]);
    }

    public function update(Request $request, $tagId){
        abort_unless(Gate::before('update', $request->user()));
        $request->validate([
            'tag' => 'required'
        ]);

        $tag = Tag::where('id', $tagId)->first();
        $tag->tag = $request->tag;
        $tag->save();

        return response()->json(['message' => 'tag.update_success', 'tag' => $tag]);
    }

    public function delete(Request $request, $tagId){
        abort_unless(Gate::before('update', $request->user()));

        $tag = Tag::where('id', $tagId)->first();
        $tag->delete();

        return response()->json(['message' => 'tag.delete_success', 'tagId' => $tagId]);
    }


}
