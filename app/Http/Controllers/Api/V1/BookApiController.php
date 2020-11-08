<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Service\BookService;
use Illuminate\Http\Request;

class BookApiController extends Controller
{
    private $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function index() {
        return response($this->bookService->getAll());
    }

    public function exclusive() {
        return response($this->bookService->getExclusive());
    }

    public function popular() {
        return response($this->bookService->getPopular());
    }

    public function new() {
        return response($this->bookService->getNew());
    }

    public function show($id) {
        return response($this->bookService->getOne($id));
    }

    public function store(BookRequest $request) {
        return response($this->bookService->create($request));
    }

    public function update(BookRequest $request, $id) {
        return response($this->bookService->update($request, $id));
    }

    public function delete($id) {
        return response($this->bookService->delete($id));
    }
}
