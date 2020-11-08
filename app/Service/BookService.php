<?php


namespace App\Service;


use App\Http\Requests\BookRequest;

interface BookService
{
    public function create(BookRequest $request);
    public function update(BookRequest $request, $id);
    public function getAll();
    public function getExclusive();
    public function getPopular();
    public function getNew();
    public function getOne($id);
    public function delete($id);
    public function sortByCategory(BookRequest $request);
    public function search(BookRequest $request);
}
