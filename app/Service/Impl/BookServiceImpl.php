<?php


namespace App\Service\Impl;


use App\Http\Requests\BookRequest;
use App\Models\Books\Book;
use App\Models\Books\Category;
use App\Models\User;
use App\Service\BookService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BookServiceImpl implements BookService
{

    public function create(BookRequest $request)
    {
        if ($files = $request->file('image')) {
            $book = new Book();
            $book->title = $request->get("title");
            $book->description = $request->get("description");
            $book->count = $request->get("count");
            $book->price = $request->get("price");
            $book->exclusive = $request->get("exclusive");

            $file = Storage::putFile('images', $request->file('image'));
            $book->image = $file;


            $book->save();
            $book->category()->sync($request->get('category_id'));
//            DB::table("category_books")->insert([
//                "category_id" => $request->get("category_id"),
//                "book_id" => $book->id
//            ]);

            return $book = Book::with("category")->findOrFail($book->id);
        }


    }

    public function update(BookRequest $request, $id)
    {
        $book = Book::findOrFail($id);
        $category = $book->category()
            ->where("name", $request->get("category"))->exists();
        $book->title = $request->get("title");
        $book->description = $request->get("description");
        $book->count = $request->get("count");
        $book->price = $request->get("price");
        $book->exclusive = $request->get("exclusive");
        $book->save();
        $book->category()->sync($request->get('category_id'));

//        DB::table("category_books")->update([
//            "category_id" => $category->id,
//            "book_id" => $book->id
//        ]);
    }

    public function getAll()
    {
        return Book::with("category", "comment")->get();
    }

    public function getExclusive()
    {
        return Book::with("category", "comment")->where("exclusive", "=", 1)->get();
    }

    public function getPopular()
    {
        return Book::with("category", "comment")->where("popular", "=", 1)->get();
    }

    public function getNew()
    {
        return Book::with("category", "comment")->where("new", "=", 1)->get();
    }

    public function getOne($id)
    {
        $book = Book::with("category", "comment")->findOrFail($id);
        $book->views += 1;
        if($book->views >= 20) {
            $book->popular = 1;
        }

        $book->save();
        return $book;
    }

    public function delete($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return Book::with("category")->get();
    }

    public function sortByCategory(BookRequest $request)
    {
        $category_id = $request->get('category_id');

//        dd($category_id);

        $books = Book::with('category')->whereHas('category', function ($q) use ($category_id) {
            $q->where('id', $category_id);
        })->get();

        return $books;
    }

    public function search(BookRequest $request)
    {
        $search = $request->get('search');

        $book = Book::with("category")
            ->where('title', 'like', '%'.$search.'%')
            ->get();

        return $book;
    }
}
