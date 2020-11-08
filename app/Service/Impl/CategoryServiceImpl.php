<?php


namespace App\Service\Impl;


use App\Http\Requests\CategoryRequest;
use App\Models\Books\Category;
use App\Service\CategoryService;

class CategoryServiceImpl implements CategoryService
{

    public function create(CategoryRequest $request)
    {
        $category = new Category();
        $category->name = $request->get("name");

        $category->save();

        return $category;
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);

        $category->name = $request->get("name");

        $category->save();

        return $category;
    }

    public function getAll()
    {
        return Category::with("book")->get();
    }

    public function getOne($id)
    {
        return Category::with("book")->findOrFail($id);
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return Category::all();
    }
}
