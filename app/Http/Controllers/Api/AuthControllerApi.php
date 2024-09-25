<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthControllerApi extends Controller
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

      
    public function login(Request $request){
        try{
         $validateUser = Validator::make($request->all(),
         [
          'email' => 'required|email',
          'password'=>'required'
         ]);

         if($validateUser->fails()){
            return response()->json([
                'status'=> false,
                'message'=>'validation error',
                'errors'=> $validateUser->errors()
            ],401);
         }
         if(!Auth::attempt($request->only(['email','password']))){
            return response()->json([
                'status'=> false,
                'message'=>'Email & Password does not macthed',
                'errors'=> $validateUser->errors()
            ],401); 
         }
         $user = User::where('email' ,$request->email)->first();
         return response()->json([
            'status' => true,
            'message'=>'Login successfuly',
            'token'=>$user->createtoken("API TOKEN")->plainTextToken
         ],200);
        }catch(\Throwable $th){
        return response()->json([
            'status'=> false,
            'message'=>$th->getMessage(),
        ],500);
        }
    }

    public function profile(){
        $userData = auth()->user();
       return response()->json([
        'status'=>true,
        'message'=>'Profile Login User',
        'data'=>$userData,
        'id'=>auth()->user()->id
       ], 200);
    }
    // public function auth(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     $user = User::where('email', $request->email)->first();

    //     if (!$user || !Hash::check($request->password, $user->password)) {
    //         return response()->json([
    //             'message' => 'Invalid credentials'
    //         ], 401);
    //     }

    //     $token = $user->createToken('auth_token')->plainTextToken;

    //     return response()->json([
    //         'access_token' => $token,
    //         'token_type' => 'Bearer',
    //     ]);
    // }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
