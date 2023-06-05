<?php

namespace App\Http\Controllers;
use App\Models\cart;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function __construct()
    {
        $this->cart = new Cart();
    }

    public function index(){
        // session()->flush();

        if(isset(session()->all()['cart']) && session()->get('cart') != null && !isset(session()->all()['user'])){
            $cart = session()->get('cart');
            return view('client/cart', compact('cart'));
        }
        elseif(isset(session()->all()['cart']) && session()->get('cart') != null && isset(session()->all()['user'])){
            $data = $this->cart->addToCart('');
            return view('client/cart', compact('data'));
        }
        elseif(!isset(session()->all()['cart']) && isset(session()->all()['user']) || isset(session()->all()['user'])){
            $data = $this->cart->getCart('');
            return view('client/cart', compact('data'));
        }
        else{
            return view('client/cart');
        }

        
    }

    public function addToCart(Request $request) {
        $this->cart->addToCart($request->all());
        $cart = session()->get('cart');


        ?>
            <script>
                alert('Thêm vào giỏ hàng thành công');
                history.back();
            </script>
        <?php
    }

    public function deleteFromCart(Request $request) {
        $this->cart->deleteFromCart($request->all());
        return redirect('/giohang');
    }



    // test k ...
    public function update_cart_item_quantity(Request $request)
    {
        // dd($_GET);
        $data = [
            $productId = $_GET['id'],
            $quantity = $_GET['soluong'],
            $function = $_GET['hanhdong']
        ];

        // $this->cart->update_cart_item_quantity($request->all());
        $this->cart->update_cart_item_quantity($data);
        return back();
    }
}
