<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index($id = null)
    {
        // dd(Auth::user()->role_id);

        $city = City::all();
       $role = Role::all();
        return view('components.add-data.add-user', [
            'city' => $city,
            'role' => $role
        ]);
      
    }
    public function show($id = null)
    {
        $user = User::with('city')->get(); // Load city relationship
        $editUser = $id ? User::findOrFail($id) : null; // Jika ada ID, ambil data user untuk di-edit
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
            'role_id' => 'required|string',
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
            'role_id.required' => 'role has to select',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
             $filename = str_replace(' ','_', $request->name) . '.'. $image->getClientOriginalExtension();
            $path = 'images-users/' . $filename;

        // Storage::disk('public')->put($path,file_get_contents($image));

    
            $image->move(public_path('images/users'), $filename);
            $user['image'] = $filename; 
        }

        $user = new User();
        $user->name = $request->name;
        $user['image'] = $filename;
        $user->email = $request->email;
        $user['password'] = Hash::make($request->password);
        $user->birthday = $request->birthday;
        $user->cities_id = $request->cities_id;
        $user->role_id = $request->role_id;
        $user->save();

        return redirect()->route('user-list.show')->with('success', 'User Data has been added.');
    } 
    public function detail($id){
       $user = User::findOrFail($id);

       return view('user-list.show', compact('user'));
    }
    public function edit($id)
    {
        $user = User::find($id); 
        $city = City::all(); 
        $role = Role::all(); 
    
        if (!$user) {
            return redirect()->route('user-list.show')->with('error', 'User not found');
        }
    
        // Kirim data user dan city ke view edit
        return view('components.add-data.add-user', [
            'user' => $user,
            'city' => $city,
            'role' => $role
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $user = User::find($id);
    
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|mimes:png,jpeg,jpg', 
            'email' => 'required|email|unique:users,email,'. $id,
            'password' => 'nullable|string|min:8|max:20', 
            'birthday' => 'required|date',
            'cities_id' => 'required|exists:cities,id', 
            'role_id' => 'required|exists:role,id',
        ]);
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
             $filename = str_replace(' ','_', $request->name) . '.'. $image->getClientOriginalExtension();
            $path = 'images-users/' . $filename;

        // Storage::disk('public')->put($path,file_get_contents($image));

    
            $image->move(public_path('images/users'), $filename);
            $user['image'] = $filename; 
        }
    
     
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        
        
        if ($request->filled('password')) {
            $user['password'] = Hash::make($request->input('password'));
        }
    
        $user->birthday = $request->input('birthday');
        $user->cities_id = $request->input('cities_id');
        $user->role_id = $request->input('role_id');
        
        $user->save();
    
        return redirect()->route('user-list.show')->with('success', 'User updated successfully');
    }
    

    public function delete($id) {
        $user = User::find($id);  // Mengacu ke tabel user_model
        $user->delete();
        return redirect()->route('user-list.show')->with('success', 'User has been deleted');
    }
public function role(){
    $role = Role::all();

    // Kirim data ke view
    return view('components.add-data.read-data.role', ['role' => $role]);
}


}
