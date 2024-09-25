<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class CityControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'city'=>City::latest()->get(),
            'message'=>'City List',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
         'city_name'=>'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => Response::HTTP_BAD_REQUEST,
                'errors' => $validator->errors(),
                'message' => 'Validation failed',
            ], Response::HTTP_BAD_REQUEST);
        }
        try{
           City::create([
            'city_name' => $request->city_name,
           ]);
           return response()->json([
             'status'=>Response::HTTP_OK,
             'message'=>'Data was added to db'
           ],Response::HTTP_OK);
        }catch(Exception $e){
           Log::error('Error adding data :'. $e->getMessage());

           return response()->json([
            'status'=> Response::HTTP_INTERNAL_SERVER_ERROR,
            'message'=>'Failed added data'
           ],Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
