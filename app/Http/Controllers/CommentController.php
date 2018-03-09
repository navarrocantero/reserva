<?php

namespace App\Http\Controllers;

use App\Comment;
use App\House;
use App\Http\Requests\CreateCommentAjaxRequest;
use App\Http\Requests\CreateCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;


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

    public function store(CreateCommentRequest $request)
    {
        $userId = $request->user()->id;
        $houseSlugNameUrl = str_replace(["house/", "/comment"], "", $request->path());

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

    public function destroy(Request $request)
    {
        $user = Auth::user();
        $commentID = $_POST['comment-id'];
        $comment = Comment::where(['id' => $commentID])->firstOrFail();
        if ($comment->user_id === $user->id) {
            $comment->delete();
            return redirect()->back()->with('success', 'Comentario eliminada con exito');;
        } else {
            return redirect()->back()->with('error', 'No se ha eliminado el comentario');;

        }
    }

    public function profile(Request $request)
    {
        $user = $request->user();

        $comments = Comment::where('user_id', $user->id)->get();
        return view('user.profile',
            [
                'comments' => $comments,
                'user' => $user
            ]
        );
    }

    public function edit(Request $request)
    {

        $user = $request->user();
        $commentID = $_GET['id'];
        $comment = Comment::where(['id' => $commentID])->firstOrFail();
        if ($comment->user_id === $user->id) {
            return View::make('comment.edit', ['comment' => $comment])->render();
        }
    }

    public function update(UpdateCommentRequest $request)
    {
        $user = Auth::user();
        $commentId = str_replace(["comment/update/"], "", $request->path());
        $comment = Comment::where(['id' => $commentId])->firstOrFail();

        if ($comment->user()->firstOrFail()->id === $user->id) {
            $comment->update(
                ['comment' => $request->input('comment')]
            );
            return redirect()
                ->back()
                ->with('success', 'Datos actualizados');
        } else {
            return redirect()->back();
        }
    }
}
