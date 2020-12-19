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

        $cart = Cart::with('user')->where('book_id', $id)->first();

        if ($cart) {
            $cart->bookCount += 1;
            $cart->bookPrice += $book->price;

            $book->save();
            $cart->save();

            return $book;
        }

        $cart = new Cart();
        $cart->bookTitle = $book->title;
        $cart->bookCount = 1;
        $cart->bookPrice = $book->price;
        $cart->book_id = $book->id;

        $cart->user_id = Auth::id();

        $book->save();
        $cart->save();

        return $book;
    }

    public function removeFromCart($id)
    {
        $cartBook = Cart::where('user_id', Auth::id())
            ->findOrFail($id);

        $book = Book::findOrFail($cartBook->book_id);
        $book->count+=$cartBook->bookCount;

        $book->save();
        $cartBook->delete();
    }

    public function removeOneFromCart($id)
    {
        $cartBook = Cart::where('user_id', Auth::id())
            ->findOrFail($id);
        $cartBook->bookCount--;

        $book = Book::findOrFail($cartBook->book_id);
        $book->count++;

        $book->save();
        $cartBook->save();


        if ($cartBook->bookCount === 0) {
            $cartBook->delete();
        }

        return $book;
    }
}
