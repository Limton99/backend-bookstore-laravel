<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Books\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $categorise = Category::simplePaginate(5);
        return view('pages.categories', ['categories' => $categorise])
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function store(Request $request) {
        $category = new Category();
        $category->name = $request->input("name");


        $category->save();


        return redirect()->route('categories');

    }

    public function update(Request $request, $id=0) {
        $id = $request->id;
        $category = Category::findOrFail($id);
        $category->name = $request->input("name");


        $category->save();


        return redirect()->route('categories');

    }

    public function destroy($id) {
        $category = Category::findOrFail($id);

        $category->delete();

        return redirect()->route('categories');
    }
}
