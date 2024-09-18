<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session; // Import facade Session

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:50',
            'password' => 'required|max:50'
        ]);
        

        if (Auth::attempt($request->only('email', 'password'), $request->remember)) {
            session()->flash('success', 'Login successful! Welcome to the dashboard.');
            return redirect('/dashboard');
        }

        return back()->with('failed', 'Email or password may be wrong!');
    }

    public function index()
    {
        return view('auth.login');
        // return view('auth.register');
    }
    public function index2(){
        return view('auth.register');
    }

    /**
     * Logout the user and invalidate the session.
     */
    public function logout(Request $request)
    {
      // Menghapus semua data sesi
    Session::flush(); 
    // Mengeluarkan pengguna dari sistem
    Auth::logout();   
  
    // Redirect ke halaman login dengan pesan
    return redirect()->route('login')->with('alert-message', 'You have been logged out.');
    }

    public function signup(Request $request){
     $request->validate([
        'email'=>'required|email|string|max:50|unique:users',
        'password'=>'required|max:50',
     ]);

    $user = new User();
    
    $user->email = $request->email;
    $user->password = Hash::make($request->password);

    $user->save();

     return redirect()->route('login')->with('alert-signup', 'You have been Registered');
    }
    public function dashboard(){
        return view('dashboard');
    }

    // Metode lainnya...
}
