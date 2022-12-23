<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class UserProductsController extends Controller
{
    function __construct()
    {
        Config::set('auth.defaults.guard', 'api');
        // $this->middleware('auth:api');
    }

    /**
     * Get all product.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function index(){
        $products = Products::with(['photos' => function ($query) {
            $query->where('is_default', 1);
        }])->take(6)->get();
        return response()->json($products);
    }

    /**
     * Get one product.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function detail(){
        
        $products = Products::with('photos')->find(request()->get('id'));
        return response()->json($products);
    }

    public function filter(){

        $products = Products::with(['photos' => function ($query) {
            $query->where('is_default', 1);
        }]);

        $products->when(request()->get('category') != null, function($query){
            $query->whereCategory(request()->get('category'));
        });

        $products->when(request()->get('brand') != null, function($query){
            $query->whereBrand(request()->get('brand'));
        });

        $products->when(request()->get('color') != null, function($query){
            $query->whereColor(request()->get('color'));
        });

        $products->when(request()->get('search') != null, function($query){
            $query->where(function($query){
                $query->where('category','like','%'.request()->get('search').'%')
                    ->orWhere('brand','like','%'.request()->get('search').'%')
                    ->orWhere('color','like','%'.request()->get('search').'%')
                    ->orWhere('name','like','%'.request()->get('search').'%');
            });
        });

        return response()->json($products->get());
    }
}
