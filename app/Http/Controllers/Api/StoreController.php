<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $stores = User::where('roles', 'seller')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'List Store',
            'data' => $stores,
        ]);

    }

    //product by store
    public function productByStore(Request $request, $id)
    {
        $products = Product::where('seller_id', $id)->get();
        return response()->json([
            'status' => 'success',
            'message' => 'List Product by store',
            'data' => $products,
        ]);
    }

}
