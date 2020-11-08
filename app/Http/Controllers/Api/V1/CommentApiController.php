<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Service\CommentService;
use Illuminate\Http\Request;

class CommentApiController extends Controller
{
    private $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function index() {
        return response($this->commentService->getAll());
    }

    public function show($id) {
        return response($this->commentService->getOne($id));
    }

    public function store(Request $request) {
        return response($this->commentService->create($request));
    }

    public function update(Request $request, $id) {
        return response($this->commentService->update($request, $id));
    }

    public function delete($id) {
        return response($this->commentService->delete($id));
    }
}
