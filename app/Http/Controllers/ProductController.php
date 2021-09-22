<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
     // Show all products
     public function index()
     {
         $products = Product::paginate(9);
         return view('products.index',compact('products'));
     }


     // Add to cart
     public function addToCart(Product $product){
        if(session()->has('cart')){
            $cart = new Cart(session()->get('cart'));
        }else{
            $cart = new Cart();
        }
        $cart->add($product);
        $product->quantity = $product->quantity - 1;
        $product->save();
        session()->put('cart', $cart);
        return redirect()->back()->with('success','Product add to cart successfuly');
    }

    // Show Cart

    public function showCart(){
        if(session()->has('cart')){
            $cart = new Cart(session()->get('cart'));
        }else{
            $cart = null;
        }
        return view('cart.show',compact('cart'));
    
   }

   // Update Cart

   public function update(Request $request, Product $product)
   {
       $request->validate([
           'qty' => 'required|numeric|min:1'
       ]);

       $cart = new Cart(session()->get('cart'));
       $cart->updateQty($product->id, $request->qty);
       session()->put('cart', $cart);
       return redirect()->route('cart.show')->with('success', 'Product updated');
   }

   //Remove from cart
   public function destroy(Product $product)
   {
       $cart = new Cart(session()->get('cart'));
       $product->quantity = $product->quantity +  $cart->totalQty ;
       $product->save();
       $cart->remove($product->id);

       if ($cart->totalQty <= 0) {
           session()->forget('cart');
       } else {
           session()->put('cart', $cart);
       }
       return redirect()->route('cart.show')->with('success', 'Product was removed');
   }
}
