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

    public function index(Request $request) {
        return response($this->cartService->showCart($request));
    }

    public function addToCart(Request $request) {
        return response($this->cartService->addToCart($request));
    }

    public function update(Request $request) {
        return response($this->cartService->updateCart($request));
    }

    public function remove(Request $request) {
        return response($this->cartService->removeFromCart($request));
    }
}
