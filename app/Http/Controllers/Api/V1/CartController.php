<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Service\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index() {
        return response($this->cartService->showCart());
    }

    public function addToCart($id) {
        return response($this->cartService->addToCart($id));
    }

    public function update(Request $request) {
        return response($this->cartService->updateCart($request));
    }

    public function remove($id) {
        return response($this->cartService->removeFromCart($id));
    }
}
