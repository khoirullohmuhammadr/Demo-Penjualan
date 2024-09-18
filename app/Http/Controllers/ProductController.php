<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index($id = null) {
        // Load all products and check if we're editing a specific one
        $products = Product::all();
        $editProduct = $id ? Product::findOrFail($id) : null;
        
        return view('components.add-data.product-management.add-product', [
            'products' => $products,
            'editProduct' => $editProduct 
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'image' => 'required|mimes:png,jpeg,jpg',
        ], [
            'product_name.required' => 'Product name field is required',
            'image.required' => 'Image field is required',
            'image.mimes' => 'File type must be: png, jpg, jpeg',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
             $filename = str_replace(' ','_', $request->name) . '.'. $image->getClientOriginalExtension();
            $path = 'images-products/' . $filename;

        // Storage::disk('public')->put($path,file_get_contents($image));

    
            $image->move(public_path('images/products'), $filename);
            $product['image'] = $filename; 
        }

        // Save product data
        $product = new Product();
        $product->product_name = $request->product_name;
        $product['image'] = $filename;
        $product->save();

        return redirect()->route('add-product')->with('success', 'New Product has been added.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:png,jpg,jpeg',
        ]);
    

        $product = Product::findOrFail($id);
    
 
        $product->product_name = $request->input('product_name');
    
        if ($request->hasFile('image')) {
 
            $image = $request->file('image');
            $filename = str_replace(' ', '_', $request->product_name) . '.' . $image->getClientOriginalExtension();
    
       
            $image->move(public_path('images/products'), $filename);
    
     
            $product->image = $filename;
        }
        $product->save();
    
        return redirect()->route('add-product')->with('success', 'Product Data has been updated.');
    }
    

    public function delete($id) {
        $product = Product::findOrFail($id);
        
        // Delete the image if it exists
        if ($product->image) {
            Storage::disk('public')->delete('image-products/' . $product->image);
        }

        $product->delete();

        return redirect()->route('add-product')->with('success', 'Product has been deleted.');
    }
}
