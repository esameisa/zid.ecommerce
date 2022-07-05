<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Cart;
use App\Models\CartProduct;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCartRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCartRequest $request)
    {
        // Create cart
        $cart = Cart::create([
            'user_id' => auth()->id(),
            'status' => 'pending',
        ]);

        // Add products to cart
        foreach ($request->products as $product) {
            CartProduct::create([
                'cart_id' => $cart->id,
                'product_id' => $product['id'],
                'quantity' => $product['quantity'],
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Cart created successfully',
            'data' => $cart->loadMissing('products')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCartRequest  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCartRequest $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
