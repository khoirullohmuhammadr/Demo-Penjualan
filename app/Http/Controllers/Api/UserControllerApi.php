<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class UserControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
         'user'=>User::latest()->get(),
         'message'=>'User List',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
  public function store(Request $request)
{
    // Validasi Input
    $validator = Validator::make($request->all(),[
        'name' => 'required',
        'image' => 'required', // Handle image upload separately if it's a file
        'email' => 'required|email|unique:users,email', // Validate unique email
        'password' => 'required|min:6',
        'birthday' => 'required|date',
        'cities_id' => 'required|exists:cities,id', // Validate foreign key
        'role_id' => 'required|exists:role,id', // Validate foreign key
    ]);

    if($validator->fails()){
        return response()->json([
            'status' => Response::HTTP_BAD_REQUEST,
            'errors' => $validator->errors(),
            'message' => 'Validation failed',
        ], Response::HTTP_BAD_REQUEST);
    }

    try {
     
        $imagePath = $request->file('image')->store('images', 'public');

        // Simpan Data User
        User::create([
            'name' => $request->name,
            'image' => $request->image, 
            'email' => $request->email,
            'password' => bcrypt($request->password), 
            'birthday' => Carbon::parse($request->birthday)->toDateString(), 
            'cities_id' => $request->cities_id, 
            'role_id' => $request->role_id, 
        ]);

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
