<?php


namespace App\Service;




use Illuminate\Http\Request;

interface CartService
{
    public function showCart(Request $request);
    public function addToCart(Request $request);
    public function updateCart(Request $request);
    public function removeFromCart(Request $request);
}
