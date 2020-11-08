<?php


namespace App\Service\Impl;


use App\Models\Comment;
use App\Models\User;
use App\Service\CommentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentServiceImpl implements CommentService
{

    public function create(Request $request)
    {
        $comment = new Comment();
        $comment->comment = $request->get("comment");
        $comment->user_id = Auth::id();
        $comment->book_id = $request->get("book_id");

        $comment->save();

        return $comment;


    }

    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        if ($comment->user_id == Auth::user()->id) {
            $comment->comment = $request->get("comment");

            $comment->save();

            return $comment;
        }
        else {
            return "You can not update it";
        }


    }

    public function getAll()
    {
        return Comment::with("user", "book")->get();
    }

    public function getOne($id)
    {
        return Comment::with("users", "books")->findOrFail($id);
    }

    public function delete($id)
    {
        $comment = Comment::findOrFail($id);

        if(Auth::user()->id == $comment->user_id || Auth::user()->isAdmin()) {
            $comment->delete();
        }
        else {
            return "You can not delete it";
        }

    }
}
