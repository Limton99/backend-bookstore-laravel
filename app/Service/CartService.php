<?php


namespace App\Service;




use Illuminate\Http\Request;

interface CartService
{
    public function showCart();
    public function addToCart($id);
    public function updateCart(Request $request);
    public function removeFromCart(Request $request);
}
