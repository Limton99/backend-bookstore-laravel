<?php


namespace App\Service\Impl;


use App\Models\Books\Book;
use App\Models\Books\Cart;
use App\Service\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MongoDB\Driver\Session;

class CartServiceImpl implements CartService
{

    public function showCart(Request $request)
    {
        $user_id = $request->get('user_id');
//        dd($user_id);
        return Cart::with('user')->where('user_id', Auth::id())->get();
    }

    public function addToCart(Request $request)
    {
        $book_id = $request->get('book_id');

        $book = Book::findOrFail($book_id);



        $cart = new Cart();
        $cart->bookTitle = $book->title;
        $cart->bookCount = $book->count;
        $cart->bookPrice = $book->price;
        $cart->book_id = $book->id;

        $cart->user_id = Auth::id();

        $cart->save();

        return Cart::with('user')->where('user_id', Auth::id())->get();
    }

    public function updateCart(Request $request)
    {
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function removeFromCart(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
}
