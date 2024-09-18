<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index($id = null)
    {
        $city = City::all();
        return view('components.add-data.add-user', [
            'city' => $city
        ]);
    }
    public function show($id = null)
    {
        $user = UserModel::with('city')->get(); // Load city relationship
        $editUser = $id ? UserModel::findOrFail($id) : null; // Jika ada ID, ambil data user untuk di-edit
        return view('components.add-data.read-data.user-list', [
            'user' => $user,
            'editUser' => $editUser // Mengirimkan data user yang akan diedit jika ada
        ]);
    }
    
    public function store(Request $request)
    {
        // dd($request->all()); 
        // dd(Hash::make($request->password));
        // dd($request->file('image'));
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|mimes:png,jpeg,jpg',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8|max:20',
            'birthday' => 'required|date|',
            'cities_id' => 'required|string',
        ], [
            'name.required' => 'Name field is required',
            'image.required' => 'image field is required',
            'image.mimes' => 'File type must be: png,jpg,jpeg',
            'email.required' => 'email field is required',
            'email.email' => 'email formating not valid',
            'password.required' => 'password field is required',
            'password.min' => 'password has not less below 8 character',
            'password.max' => 'password has not max beyod 20 character',
            'birthday.required' => 'Date field is required',
            'birthday.date' => 'Date format not valid',
            'cities_id.required' => 'Cities has to select',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
             $filename = str_replace(' ','_', $request->name) . '.'. $image->getClientOriginalExtension();
            $path = 'images-users/' . $filename;

        // Storage::disk('public')->put($path,file_get_contents($image));

    
            $image->move(public_path('images/users'), $filename);
            $user['image'] = $filename; 
        }

        $usermodel = new UserModel();
        $usermodel->name = $request->name;
        $usermodel['image'] = $filename;
        $usermodel->email = $request->email;
        $usermodel['password'] = Hash::make($request->password);
        $usermodel->birthday = $request->birthday;
        $usermodel->cities_id = $request->cities_id;
        $usermodel->save();

        return redirect()->route('user-list.show')->with('success', 'User Data has been added.');
    } 
    public function detail($id){
       $user = UserModel::findOrFail($id);

       return view('user-list.show', compact('user'));
    }
    public function edit($id)
    {
        $user = UserModel::find($id); // Mengambil data user berdasarkan ID
        $city = City::all(); // Mengambil semua data kota
    
        if (!$user) {
            return redirect()->route('user-list.show')->with('error', 'User not found');
        }
    
        // Kirim data user dan city ke view edit
        return view('components.add-data.add-user', [
            'user' => $user,
            'city' => $city // Kirimkan data kota ke view
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $user = UserModel::find($id);
    
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|mimes:png,jpeg,jpg', // Image is nullable, but if provided, check format
            'email' => 'required|email|unique:user_models,email,'. $id,
            'password' => 'nullable|string|min:8|max:20', // Password can be null
            'birthday' => 'required|date',
            'cities_id' => 'required|exists:cities,id', // Check cities ID exists in the cities table
        ]);
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
             $filename = str_replace(' ','_', $request->name) . '.'. $image->getClientOriginalExtension();
            $path = 'images-users/' . $filename;

        // Storage::disk('public')->put($path,file_get_contents($image));

    
            $image->move(public_path('images/users'), $filename);
            $user['image'] = $filename; 
        }
    
        // Update user details
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        
        // Only update the password if it's provided
        if ($request->filled('password')) {
            $user['password'] = Hash::make($request->input('password'));
        }
    
        $user->birthday = $request->input('birthday');
        $user->cities_id = $request->input('cities_id');
        
        // Save updated user data
        $user->save();
    
        return redirect()->route('user-list.show')->with('success', 'User updated successfully');
    }
    

    public function delete($id) {
        $user = UserModel::find($id);  // Mengacu ke tabel user_model
        $user->delete();
        return redirect()->route('user-list.show')->with('success', 'User has been deleted');
    }



}
