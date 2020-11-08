<?php


namespace App\Service;


use App\Http\Requests\CategoryRequest;

interface CategoryService
{
    public function create(CategoryRequest $request);
    public function update(CategoryRequest $request, $id);
    public function getAll();
    public function getOne($id);
    public function delete($id);
}
