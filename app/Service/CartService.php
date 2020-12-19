<?php


namespace App\Service;




use Illuminate\Http\Request;

interface CartService
{
    public function showCart();
    public function addToCart($id);
    public function removeFromCart($id);
    public function removeOneFromCart($id);
}
