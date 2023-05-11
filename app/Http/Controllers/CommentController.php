<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth()->id();
        $comments = DB::table('comments')->where('userId', $id)->get()->toArray();
        return view('pages.user.comments.index');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCommentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentRequest $request)
    {
        $userId = auth()->id();
        $comment = Comment::create([
            'comment' => $request->comment,
            'userId' => $userId,
            'AnnounceId' => $request->AnnounceId
        ]);
        return redirect()->back();
    }

    public function show($announce_id){
        $comments = DB::table('comments')->where('AnnounceId', $announce_id)->get()->toArray();
        return view('pages.user.comments.index', compact('comments'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
