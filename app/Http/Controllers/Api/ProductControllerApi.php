<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductControllerApi extends Controller
{
    public function index()
    {
        return response()->json([
            'product'=>Product::latest()->get(),
            'message'=>'Product List',
        ]);
    }
}
