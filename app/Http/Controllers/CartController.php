<?php

namespace App\Http\Controllers;

use App\Cart;
use App\User;
use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($token)
    {
        $userId = User::where('api_token', $token)->first()->id;

        // $cartId = Cart::where('user_id', $userId)->first()->id;

        $data = Cart::where('user_id', $userId)
                    ->join('products', 'carts.product_id', '=', 'products.id')
                    ->get([
                        'carts.id as cartsId',
                        'carts.user_id',
                        'carts.product_id',
                        'carts.quantity',
                        'carts.total',
                        'carts.size',
                        'products.id as productId',
                        'products.name',
                        'products.price',
                        'products.color',
                        'products.size',
                        'products.description',
                        'products.category',
                        'products.picture'
                    ]);

        return response()->json([
            'message' => 'Success',
            'data' => $data
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productId = $request->product['id'];

        $token = $request->data['token'];
        $userId = User::where('api_token', $token)->first()->id;

        $quantity = $request->data['quantity'];
        $size = $request->data['size'];

        $price = $request->product['price'];

        $total = intval($quantity) * intval($price);
        
        $carts = Cart::where('user_id', $userId)->get();
        
        foreach($carts as $cart) {
            if($cart->product_id == $productId) {
                $cartQuantity = Cart::where('product_id', $cart->product_id)->first()->quantity;
                $cartPrice = Cart::where('product_id', $cart->product_id)
                                ->join('products', 'carts.product_id', '=', 'products.id')
                                ->first()->price;

                $cartPrice = intval($cartPrice);           
                $cartQuantity = intval($cartQuantity);

                Cart::where('product_id', $productId)->update([
                    'quantity' => $cartQuantity + $quantity,
                    'total' => $cartPrice * ($cartQuantity + $quantity)
                ]);

                return response()->json([
                    'message' => 'Success'
                ], 200);
            }
        }
        
        Cart::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'quantity' => $quantity,
            'total' => $total,
            'size' => $size
        ]);

        return response()->json(['message' => 'Success'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cart = Cart::where('product_id', $id)->delete();

        return response()->json([
            'message' => 'Success'
        ], 200);
    }

    public function plus(Request $request) {
        $cartId = $request->cartId;
        $productId = $request->productId;
        $quantity = $request->quantity;

        $price = $request->price;
        $price = intval($price);

        $quantity = intval($quantity) + 1;

        Cart::where([
            'id' => $cartId,
            'product_id' => $productId 
        ])->update([
            'quantity' => $quantity,
            'total' => $quantity * $price
        ]);

        return response()->json([
            'message' => 'success'
        ], 200);
    }

    public function minus(Request $request) {
        $cartId = $request->cartId;
        $productId = $request->productId;
        $quantity = $request->quantity;
        $price = $request->price;
        $price = intval($price);

        $quantity = intval($quantity) - 1;

        Cart::where([
            'id' => $cartId,
            'product_id' => $productId 
        ])->update([
            'quantity' => $quantity,
            'total' => $quantity * $price
        ]);

        return response()->json([
            'message' => 'success'
        ], 200);
    }

    public function total($token) {
        $userId = User::where('api_token', $token)->first()->id;

        $carts = Cart::where('user_id', $userId)->get();

        $cartTotal = [];
        foreach($carts as $cart){
            $cartTotal[] = $cart->total;
        }

        $total = array_sum($cartTotal);

        return response()->json([
            'message' => 'success',
            'total' => $total
        ], 200);
    }
}
