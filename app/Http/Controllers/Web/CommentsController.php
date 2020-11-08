<?php


namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentsController extends Controller
{
    public function index()
    {
        $comments = Comment::with("user", "book")->simplePaginate(5);
        return view('pages.comments', ['comments'=>$comments])
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function destroy($id) {
        $category = Comment::findOrFail($id);

        $category->delete();

        return redirect()->route('comments');
    }
}
