<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'pageTitle' => 'Admin | Products'
        ];
        return view('admin.pages.product.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'pageTitle' => 'Admin | Create Product'
        ];
        return view('admin.pages.product.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $title = trim($request->title);
        $product = new Product();
        $product->title = $title;
        $product->created_by = Auth::user()->id;

        $slug = Str::slug($title, '-');
        $checkSlug = Product::where('slug', $slug)->count();
        if (empty($checkSlug)) {
            $product->slug = $slug;
            // $product->save();
        } else {
            $newSlug = $slug . '-' . $product->id;
            $product->slug = $newSlug;
            // $product->save();
        }
        dd($product);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
