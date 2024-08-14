<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class ProductController extends Controller
{
    public function get(?string $id = null){
        if(is_null($id))
            return view('layouts/product');
        else{
            $product = Product::select('id', 'user_id', 'name', 'description', 'quantity', 'price')->where('id', $id)->first();
            return view('layouts/product', ['product' => $product]);
        }
    }

    public function create(Request $request){
        validator($request->all(), [
            'product' => ['required'],
            'description' => ['required'],
            'quantity' => ['required', 'numeric'],
            'price' => ['required', 'numeric', 'decimal:2'],
        ])->validate();

        Product::insert([
            'user_id' => Auth::id(),
            'name' => $request->product,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/products');
    }

    public function update(Request $request){
        validator($request->all(), [
            'product' => ['required'],
            'description' => ['required'],
            'quantity' => ['required', 'numeric'],
            'price' => ['required', 'numeric', 'decimal:2'],
        ])->validate();

        $product = Product::find($request->product_id);
        $product->name = $request->product;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->updated_at = now();
        $product->save();

        return redirect('/products');
    }
}
