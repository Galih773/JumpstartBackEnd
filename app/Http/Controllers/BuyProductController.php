<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BuyProductController extends Controller
{
    function __construct()
    {
        Config::set('auth.defaults.guard', 'api');
        $this->middleware('auth:api', ['except' => ['success', 'cancel']]);
    }

    public function cart(){
        $user = auth()->user();
        $cart = Cart::join('products', 'products.id', '=', 'carts.product_id')
            ->join('product_galleries', 'product_galleries.product_id', '=', 'products.id')
            ->where('carts.user_id', $user->id)
            ->where('product_galleries.is_default', 1)
            ->select('carts.*', 'products.name', 'products.price', 'products.stock', 'product_galleries.url', 'products.discount')
            ->get();
        return response()->json($cart);
    }

    public function addCart(){
        $user = auth()->user();
        $product = Products::find(request()->get('product_id'));
        $productExists = $user->cart()->where('product_id', request()->get('product_id'))->exists();

        if($productExists){

            $stockAvailable = $product->stock >= request()->get('quantity') + $user->cart()->where('product_id', request()->get('product_id'))->first()->quantity;

            if( $stockAvailable == false){
                return response()->json(['message' => 'Max Stock'], 400);
            }

            $cart = $user->cart()->where('product_id', request()->get('product_id'))->first();
            $cart->quantity = $cart->quantity + request()->get('quantity');
            $cart->save();
            return response()->json($cart);

        } else {
            $cart = $user->cart()->create([
                'product_id' => request()->get('product_id'),
                'quantity' => request()->get('quantity'),
            ]);
            return response()->json($cart);
        }
    }

    public function deleteCart(){
        $user = auth()->user();
        $cart = $user->cart()->where('product_id', request()->get('product_id'))->delete();
        return response()->json($cart);
    }

    public function decreaseCart(){
        $user = auth()->user();
        $cart = $user->cart()->where('product_id', request()->get('product_id'))->first();
        if($cart->quantity > 1){
            $cart->quantity = $cart->quantity - 1;
            $cart->save();
        }
        return response()->json($cart);
    }

    public function checkout(){
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'payment_method' => 'required',
            'shipment_method' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        
        $user = auth()->user();
        $cart = $user->cart;
        $cart->each(function($cart){
            $cart->product->stock = $cart->product->stock - $cart->quantity;
            $cart->product->save();
        });

        Stripe::setApiKey(env('STRIPE_SECRET'));

        if(request()->get('payment_method') == 'Card Payment'){
            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'unit_amount_decimal' => request()->get('total_price') * 100,
                        'product_data' => [
                            'name' => 'Total Price',
                        ],
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('checkout.success', [], true) . 
                                "?session_id={CHECKOUT_SESSION_ID}&uuid=" . request()->get('uuid') .
                                "&name=" . request()->get('name') . 
                                "&email=" . request()->get('email') . 
                                "&phone=" . request()->get('phone') .
                                "&country=" . request()->get('country') .
                                "&state=" . request()->get('state') .
                                "&city=" . request()->get('city') .
                                "&payment_method=" . request()->get('payment_method') .
                                "&shipment_method=" . request()->get('shipment_method') .
                                "&total_price=" . request()->get('total_price') .
                                "&user_id=" . $user->id,
                'cancel_url' => 'http://localhost:3000/cart/checkout',
            ]);

            return response()->json([
                'url' => $session->url
            ]);
        } else {
            $order = $user->orders()->create([
                'uuid' => request()->get('uuid'),
                'name' => request()->get('name'),
                'email' => request()->get('email'),
                'phone' => request()->get('phone'),
                'country' => request()->get('country'),
                'state' => request()->get('state'),
                'city' => request()->get('city'),
                'payment_method' => request()->get('payment_method'),
                'shipment_method' => request()->get('shipment_method'),
                'status' => 'SUCCESS',
                'total_price' => request()->get('total_price'),
            ]);
    
            $order->order_details()->createMany(
                $cart->map(function($cart){
                    return [
                        'product_id' => $cart->product_id,
                        'quantity' => $cart->quantity,
                    ];
                })->toArray()
            );
    
            $user->cart()->delete();
            return response()->json([
                'url' => 'http://localhost:3000/cart/checkout/success'
            ]);
        }
        
    }

    public function success(Request $request)
    {

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $sessionId = $request->get('session_id');
        $user = User::find($request->get('user_id'));
        $cart = $user->cart;
        try {

            $session = $stripe->checkout->sessions->retrieve($sessionId);

            if (!$session) {
                throw new NotFoundHttpException();
            }

            $order = $user->orders()->create([
                'uuid' => $request->get('uuid'),
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
                'country' => $request->get('country'),
                'state' => $request->get('state'),
                'city' => $request->get('city'),
                'payment_method' => $request->get('payment_method'),
                'shipment_method' => $request->get('shipment_method'),
                'status' => 'SUCCESS',
                'total_price' => $request->get('total_price'),
            ]);
    
            $order->order_details()->createMany(
                $cart->map(function($cart){
                    return [
                        'product_id' => $cart->product_id,
                        'quantity' => $cart->quantity,
                    ];
                })->toArray()
            );
    
            $user->cart()->delete();

            return redirect()->away('http://localhost:3000/cart/checkout/success');
        } catch (\Exception $e) {
            throw new NotFoundHttpException();
        }
    }
}
