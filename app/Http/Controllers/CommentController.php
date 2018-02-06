<?php

namespace App\Http\Controllers;

use App\Comment;
use App\House;
use App\Http\Requests\CreateCommentAjaxRequest;
use App\Http\Requests\CreateCommentRequest;
use Illuminate\Http\Request;

class CommentController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('comment.create');
    }

    public function store(Request $request)
    {
        $userId = $request->user()->id;
        $houseSlugNameUrl = str_replace(["house/","/comment" ], "", $request->path());

        $houseId = (House::where('slugname', $houseSlugNameUrl)->first())->id;

        Comment::create([
            'user_id' => $userId,
            'comment' => $request->input('comment'),
            'house_id' => $houseId
        ]);
        return back();
    }

    protected function validateAjax(CreateCommentAjaxRequest $request)
    {


        return array();
    }
}
