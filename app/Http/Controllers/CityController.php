<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\City;
use Illuminate\Support\Facades\Auth;


class CityController extends Controller
{
    public function index($id = null) {


        // dd(session()->all());
        // dd(Auth::user());
        $city = City::all();
        $editCity = $id ? City::findOrFail($id) : null;
        
        return view('components.add-data.add-city', [
            // dd($city)
            'city' => $city,
            'editCity' => $editCity // Mengirimkan data city yang akan diedit jika ada
        ]);
        
    }
    
    public function create(Request $request){

        $request->validate([
            'city_name' => 'required|string|max:255', // Validasi untuk nama_kota
        ]);

        $city = new City();
        $city->city_name = $request->city_name;
        $city->save();

        return redirect()->route('add-city')->with('success', 'City Name successfully added.');
    }
    // public function edit($id){
    //     $city = City::findOrFail($id);
    //     return view('edit-city', compact('city'));
    // }
    public function update(Request $request, $id) {
        $request->validate([
            'city_name' => 'required|string|max:255',
        ]);
    
        $city = City::findOrFail($id);
        $city->city_name = $request->input('city_name');
        $city->save();
    
        return redirect()->route('add-city')->with('success', 'City Name has been updated');
    }

    public function delete($id){
      $city = City::find($id);
      $city->delete();
      return redirect()->route('add-city')->with('success', 'City Name has been deleted');
    }
    
}
