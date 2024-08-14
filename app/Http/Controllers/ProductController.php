<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Exception;

class ProductController extends Controller
{
    public function get(?string $id = null){
        try{
        if(is_null($id))
          return view('layouts/product');
        else{
          $route = request()->route();
          $product = Product::select('id', 'user_id', 'name', 'description', 'quantity', 'price')->where('id', $id)->first();
          return view('layouts/product', ['product' => $product, 'route' => $route]);
        }
        }catch(Exception $ex){
            return redirect()->back()->withErrors('Ha ocurrido un error al intentar obtener el registro. Intentelo mas tarde');
        }
    }

    public function get_all(){
        try{
            $products = Product::select('products.id', 'products.user_id', 'products.name',
            'products.description', 'products.quantity', 'products.price', 'users.name as user_name')
            ->join('users', 'users.id', '=', 'products.user_id')
            ->where('user_id', Auth::id())->get();
            return view('layouts/products', ['products' => $products]);
        }catch(Exception $ex){
            return redirect()->back()->withErrors('Ha ocurrido un error al intentar obtener los registros. Intentelo mas tarde');
        }
    }

    public function create(Request $request){
        try{
            $validator = validator($request->all(), [
                'product' => ['required'],
                'description' => ['required'],
                'quantity' => ['required', 'numeric'],
                'price' => ['required', 'numeric', 'decimal:2'],
            ]);

            if ($validator->fails()) {
                return redirect()
                ->back()
                ->withErrors($validator);
            }

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
        }catch(Exception $ex){
            return redirect()->back()->withErrors('Ha ocurrido un error al intentar actualizar el registro. Intentelo mas tarde');
        }
    }

    public function update(Request $request){
        try{
            $validator = validator($request->all(), [
                'product' => ['required'],
                'description' => ['required'],
                'quantity' => ['required', 'numeric'],
                'price' => ['required', 'numeric', 'decimal:2'],
            ]);

            if ($validator->fails()) {
                return redirect()
                ->back()
                ->withErrors($validator);
            }

            $product = Product::find($request->product_id);
            $product->name = $request->product;
            $product->description = $request->description;
            $product->quantity = $request->quantity;
            $product->price = $request->price;
            $product->updated_at = now();
            $product->save();

            return redirect('/products');
        }catch(Exception $ex){
            return redirect()->back()->withErrors('Ha ocurrido un error al intentar eliminar el registro. Intentelo mas tarde');
        }
    }

    public function delete(string $id){
        try{
            $product = Product::find($id);
            $product->delete();
            return response()->json($product);
        }catch(Exception $ex){
            return redirect()->back()->withErrors('Ha ocurrido un error al eliminar el registro. Intentelo mas tarde');
        }
    }
}
