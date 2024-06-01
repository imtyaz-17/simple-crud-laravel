<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Define a route for the home page
Route::get('/', function () {
    return view('welcome');
});

// Group all routes related to the ProductController
Route::controller(ProductController::class)->group(function () {
    // Route to display a listing of products
    Route::get('/products', 'index')->name('products.index');
    // Route to show the form for creating a new product
    Route::get('/products/create', 'create')->name('products.create');
    // Route to store a newly created product in the database
    Route::post('/products', 'store')->name('products.store');
    // Route to show the form for editing the specified product
    Route::get('/products/{product}/edit', 'edit')->name('products.edit');
    // Route to update the specified product in the database
    Route::put('/products/{product}', 'update')->name('products.update');
    // Route to remove the specified product from the database
    Route::delete('/products/{product}', 'destroy')->name('products.destroy');
});
