<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    // Display a listing of the products
    public function index()
    {
        // Fetch all products in descending order of creation date
        $products = Product::orderBy('created_at', 'DESC')->get();
        // Return the view with the list of products
        return view('products.listproducts', [
            'products' => $products
        ]);
    }

    // Show the form for creating a new product
    public function create()
    {
        // Return the view for creating a product
        return view('products.createproduct');
    }

    // Store a newly created product in the database
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|min:3',
            'sku' => 'required|min:3',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Create a new product instance
        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;

        // Handle image upload if an image is provided
        if ($request->image != "") {
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;

            // Move the uploaded image to the specified directory
            $image->move(public_path('uploads/products'), $imageName);

            // Set the image name in the product instance
            $product->image = $imageName;
        }

        // Save the product to the database
        $product->save();
        // Redirect to the product list with a success message
        return redirect()->route('products.index')->with('success', 'Product added.');
    }

    // Show the form for editing the specified product
    public function edit($id)
    {
        // Find the product by ID, or fail if not found
        $product = Product::findOrFail($id);
        // Return the view for editing the product
        return view('products.editproduct', [
            'product' => $product
        ]);
    }

    // Update the specified product in the database
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|min:3',
            'sku' => 'required|min:3',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Find the product by ID, or fail if not found
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;

        // Handle image upload if a new image is provided
        if ($request->image != "") {
            // Delete the old image
            File::delete(public_path('uploads/products/' . $product->image));

            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext;

            // Move the uploaded image to the specified directory
            $image->move(public_path('uploads/products'), $imageName);

            // Set the new image name in the product instance
            $product->image = $imageName;
        }

        // Save the updated product to the database
        $product->save();
        // Redirect to the product list with a success message
        return redirect()->route('products.index')->with('success', 'Product Info updated.');
    }

    // Remove the specified product from the database
    public function destroy($id)
    {
        // Find the product by ID, or fail if not found
        $product = Product::findOrFail($id);
        if ($product->image != "") {
            // Delete the associated image file
            File::delete(public_path('uploads/products/' . $product->image));
        }

        // Delete the product from the database
        $product->delete();
        // Redirect to the product list with a success message
        return redirect()->route('products.index')->with('success', 'Product deleted.');
    }
}
