<?php


namespace App\Service\Impl;


use App\Models\Books\Book;
use App\Service\CartService;
use Illuminate\Http\Request;
use MongoDB\Driver\Session;

class CartServiceImpl implements CartService
{

    public function showCart()
    {
        return session()->get('cart');
    }

    public function addToCart($id)
    {
        $book = Book::find($id);
        if(!$book) {
            abort(404);
        }

        $cart = session()->get('cart');

        if(!$cart) {
            $id = [
                'title'=>$book->title,
                'quantity'=>1,
                'price'=>$book->price,
                'image'=>$book->image
            ];

            session()->put('cart', $cart);

//            return $cart;
            dd($cart);
            return [
                "success",
                "Data"=>session()->get('cart'),
            ];
        }

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;

            session()->put('cart', $cart);

            return [
                "success",
                "Data"=>$cart
            ];
        }

        $cart[$id] = [
            'name'=>$book->title,
            'quantity'=>1,
            'price'=>$book->price,
            'image'=>$book->image
        ];

        session()->put('cart', $cart);

        return [
            "success",
            "Data"=>$cart
        ];
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
