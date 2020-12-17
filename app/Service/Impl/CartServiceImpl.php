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

    public function showCart()
    {
        $cart = Cart::with('user')->where('user_id', Auth::id())->get();
        $total = 0;
        foreach ($cart as $c) {
            $total += $c->bookPrice;
        }

        $cart = [
            'cart'=>$cart,
            'total'=>$total
        ];

        return $cart;
    }

    public function addToCart($id)
    {


        $book = Book::findOrFail($id);


        $book->count--;

        $cart = new Cart();
        $cart->bookTitle = $book->title;
        $cart->bookCount = $book->count;
        $cart->bookPrice = $book->price;
        $cart->book_id = $book->id;

        $cart->user_id = Auth::id();

        $book->save();
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

    public function removeFromCart($id)
    {
//        dd(Cart::findOrFail($request->get('cart_id')));
        $cartBook = Cart::where('user_id', Auth::id())
            ->findOrFail($id);

        $book = Book::findOrFail($cartBook->book_id);
        $book->count++;
//        dd($book);

        $book->save();
        $cartBook->delete();
    }
}
