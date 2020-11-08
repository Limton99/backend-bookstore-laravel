<?php


namespace App\Service;


use Illuminate\Http\Request;

interface CommentService
{
    public function create(Request $request);
    public function update(Request $request, $id);
    public function getAll();
    public function getOne($id);
    public function delete($id);
}
