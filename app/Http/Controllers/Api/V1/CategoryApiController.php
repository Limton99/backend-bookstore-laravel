<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Service\CategoryService;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function store(CategoryRequest $request)
    {
        return response($this->categoryService->create($request));
    }

    public function update(CategoryRequest $request, $id)
    {
        return response($this->categoryService->update($request, $id));
    }

    public function index()
    {
        return response($this->categoryService->getAll());
    }

    public function show($id)
    {
        return response($this->categoryService->getOne($id));
    }

    public function delete($id)
    {
        return response($this->categoryService->delete($id));
    }
}
