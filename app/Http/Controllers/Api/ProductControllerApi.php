<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Sell;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductControllerApi extends Controller
{
    

    public function index(Request $request)
    {
        $product = Product::all();
        return response()->json([
            'status' => true,
            'message' => 'List of products',
            'data' => $product
        ], 200);
    }   

    public function sell(Request $request){

        try{
      $sell = new Sell();
      $sell->products_id = $request->products_id;
      $sell->users_id = $request->users_id;
      $sell->sell = $request->sell;
    //   $sell->date = $request->date;
      $sell->save();

      return response()->json([
        'status' => Response::HTTP_OK,
        'message' => 'Data was added to db'
    ], Response::HTTP_OK);
    
} catch(Exception $e) {
    Log::error('Error adding data: '. $e->getMessage());

    return response()->json([
        'status'=> Response::HTTP_INTERNAL_SERVER_ERROR,
        'message'=>'Failed to add data'
    ],Response::HTTP_INTERNAL_SERVER_ERROR);
}
    }

    public function dashboard()
    {
        // Mendapatkan data penjualan dengan relasi ke produk dan user
        $sell = Sell::with(['product', 'user']) // Relasi ke model Product dan User
            ->orderBy('created_at', 'desc') // Mengurutkan berdasarkan waktu pembuatan data
            ->get();
    
        // Passing data ke view
        return view('dashboard', [
            'sell' => $sell, // Passing hasil query sales
        ]);
    }
    
}
