<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::latest()->paginate(5);

        return response()->json([
            'message' => 'success',
            'data' => $product
        ],200);
    }

    public function latest() {
        $product = Product::latest()->get();

        return response()->json([
            'message' => 'Success',
            'data' => $product
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
        // $admin_id = User::where('api_token', $request->token)->first()->id;

        return $request->picture;
        // return $request->data;

        // Product::create([
        //     'name' => $request->name,
        //     'price' => $request->price,
        //     'color' => $request->color,
        //     'description' => $request->description,
        //     'category' => $request->category,
        //     'picture' => 'cloth_1.jpg',
        //     'admin_id' => $admin_id
        // ]);

        // return response()->json([
        //     'message' => 'success'
        // ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        
        return response()->json([
            'message' => 'Success',
            'data' => $product
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'color' => $request->color,
            'description' => $request->description,
            'category' => $request->category,
            'picture' => 'cloth_2.jpg'
        ]);

        return response()->json([
            'message' => 'success'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id)->delete();

        return response()->json([
            'message' => 'success'
        ], 200);
    }
}
