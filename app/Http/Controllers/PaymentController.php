<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade;

class PaymentController extends Controller
{
    public function cart(Request $request)
    {
        $data['meta_title'] = 'Cart';
        $data['products'] = CartFacade::getContent();
        foreach ($data['products'] as $product) {
            $product->image = Product::find($product->id)->images->first()->image_name;
            $product->productDetail = Product::find($product->id);
        }
        return view('payment.cart', $data);
    }
    public function add_to_cart(Request $request)
    {
        $getProduct = Product::find($request->product_id);
        $price = ProductSize::find($request->size_id)->price;

        CartFacade::add([
            'id' => $getProduct->id,
            'name' => 'Product',
            'price' => $price,
            'quantity' => $request->qty,
            'attributes' => array(
                'size_id' => $request->size_id,
                'color_id' => $request->color_id
            )
        ]);
        return redirect()->back();
    }
    public function deleteCart($id)
    {
        CartFacade::remove($id);
        return redirect()->back();
    }
    public function updateCart(Request $request)
    {
        foreach ($request->cart as $cart) {
            CartFacade::update($cart['id'], array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $cart['qty']
                ),
            ));
        }
        return redirect()->back();
    }
    public function checkout()
    {
        $data['meta_title'] = 'Checkout';
        $data['products'] = CartFacade::getContent();
        foreach ($data['products'] as $product) {
            $product->productDetail = Product::find($product->id);
        }

        return view('payment.checkout', $data);
    }
}
