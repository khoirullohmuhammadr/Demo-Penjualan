<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StokInput;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StokController extends Controller
{
    public function index($id = null)
    {
        $product = Product::all();
        return view('components.add-data.stok-management.stok-input', [
            'product' => $product
        ]);
    }
    
    public function show($id = null)
    {
        $stok = StokInput::with('product')
        ->orderBy('input_date', 'desc') // Mengurutkan berdasarkan tanggal input_date
        ->get();

    $editStok = $id ? StokInput::findOrFail($id) : null; 

    return view('components.add-data.stok-management.read-stok.stok-list', [
        'stok' => $stok,
        'editStok' => $editStok 
    ]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'products_id' => 'required|string',
            'stok' => 'required|integer',
            'input_date' => 'required|date',
        ], [
            'products_id.required' => 'Product has to select',
        ]);
    
        $stokinput = new StokInput();
        $stokinput->products_id = $request->products_id;
        $stokinput->stok = $request->stok;
        $stokinput->input_date = $request->input_date;
        $stokinput->save();
   
        return redirect()->route('stok-list.show')->with('success', 'stok Data has been added.');
    }
    public function edit($id)
    {
        $stok = StokInput::find($id); // Mengambil data user berdasarkan ID
        $product = Product::all(); // Mengambil semua data kota
    
        if (!$stok) {
            return redirect()->route('stok-list.show')->with('error', 'stok not found');
        }
    
        // Kirim data user dan city ke view edit
        return view('components.add-data.stok-management.stok-input', [
            'stok' => $stok,
            'product' => $product // Kirimkan data kota ke view
        ]);
    }
    
    
    public function update(Request $request, $id)
    {
        $stok = StokInput::find($id);
    
        // Validate input
        $request->validate([
            'products_id' => 'required|string',
             'stok' => 'required|int',
            'input_date' => 'required|date',
        ]);
    
        $stok->products_id = $request->input('products_id');
        $stok->stok = $request->input('stok');
        $stok->input_date = $request->input('input_date');
        
        // Save updated stok data
        $stok->save();
    
        return redirect()->route('stok-list.show')->with('success', 'stok updated successfully');
    }
    

    public function delete($id) {
        $stok = StokInput::find($id);  // Mengacu ke tabel stok_model
        $stok->delete();
        return redirect()->route('stok-list.show')->with('success', 'stok has been deleted');
    }



}
