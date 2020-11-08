<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Models\Books\Book;
use App\Models\Books\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;

class BooksController extends Controller
{

    public function index() {
        $books = Book::with('category')->simplePaginate(5);
        return view('pages.books', ['books'=>$books, 'categories'=>Category::all()])
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function store(Request $request) {
        if ($request->hasFile('image')) {
            $book = new Book();
            $book->title = $request->input("title");
            $book->description = $request->input("description");
            $book->count = $request->input("count");
            $book->price = $request->input("price");
            $book->exclusive = $request->input("exclusive");
            $book->popular = $request->input("popular");
            $book->new = $request->input("new");

            $file = Storage::putFile('images', $request->file('image'));
            $book->image = $file;


            $book->save();
            $book->category()->sync($request->input('category_id'));
//            DB::table("category_books")->insert([
//                "category_id" => $request->get("category_id"),
//                "book_id" => $book->id
//            ]);

            return redirect()->route('books');
        }
        else {
            return redirect()->route('books');
        }
    }

    public function update(Request $request, $id=0) {
        $id = $request->input("id");
        if ($request->hasFile('image')) {
            $book = Book::findOrFail($id);

            $book->title = $request->input("title");
            $book->description = $request->input("description");
            $book->count = $request->input("count");
            $book->price = $request->input("price");
            $book->exclusive = $request->input("exclusive");
            $book->popular = $request->input("popular");
            $book->new = $request->input("new");

            $file = Storage::putFile('images', $request->file('image'));
            $book->image = $file;

            $book->save();
            $book->category()->sync($request->input('category_id'));

            return redirect()->route('books');
        }
    }

    public function destroy($id) {
        $book = Book::findOrFail($id);

        $book->delete();

        return redirect()->route('books');
    }
}
