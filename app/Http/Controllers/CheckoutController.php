<?php

namespace App\Http\Controllers;

use App\Checkout;
use App\User;
use App\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($token)
    {
        $user = User::where('api_token', $token)->first();

        return response()->json([
            'data' => $user
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
        $userId = $request->user['id'];

        $address = $request->detail['address'];
        $country = $request->detail['country'];
        $post_code = $request->detail['post_code'];
        $phone = $request->detail['phone'];
        $order_note = $request->detail['order_note'];
        $payment_method = $request->detail['payment_method'];

        $carts = Cart::where('user_id', $userId)->get();

        $cartTotal = [];
        foreach($carts as $cart) {
            $cartTotal[] = $cart->total;
        }
        $total = array_sum($cartTotal);

        Checkout::create([
            'user_id' => $userId,
            'address' => $address,
            'country' => $country,
            'post_code' => $post_code,
            'phone' => $phone,
            'order_note' => $order_note,
            'payment_method' => $payment_method,
            'total' => $total
        ]);

        Cart::where('user_id', $userId)->delete();

        return response()->json([
            'message' => 'success'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function show(Checkout $checkout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function edit(Checkout $checkout)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checkout $checkout)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Checkout  $checkout
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checkout $checkout)
    {
        //
    }
}
