<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        try
        {
            DB::table('posts')->insert(
            ['title'=>$request->input('title'),
             'description'=>$request->input('description'),
             'user_id'=>$user->id]
            );
            
            return response()->json(['post_created'], 200);
        }
        catch(QueryException $ex)
        {
            return response()->json(['internal_error'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $postId = $request->input('id');

        if($user->id == $postId || $user->isAdmin == 1)
        {
            $post = Post::find($postId);
            $post->update([
                'title' => $request->input('title'),
                'description' => $request->input('description')
            ]);
            return response()->json(['post_updated'], 200);
        }
        
        return response()->json(['internal_error'], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $postId = $request->input('id');

        if($user->id == $postId || $user->isAdmin == 1)
        {
            $post = Post::find($postId);
            $post->delete();
            return response()->json(['post_deleted'], 200);
        }
        
        return response()->json(['internal_error'], 500);
    }
}
