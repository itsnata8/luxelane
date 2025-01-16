<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brand = new Brand();
        $brands = $brand->getAllBrands();
        foreach ($brands as $brand) {
            $brand->created_by = $brand->user->name;
        }
        $data = [
            'pageTitle' => 'Admin | Brand',
            'brands' => $brands
        ];
        return view('admin.pages.brand.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'pageTitle' => 'Admin | Create Brand',
        ];
        return view('admin.pages.brand.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug',
            'meta_title' => 'required',
        ]);
        $data = [
            'name' => trim($request->name),
            'slug' => trim($request->slug),
            'meta_title' => trim($request->meta_title),
            'meta_description' => trim($request->meta_description),
            'meta_keywords' => trim($request->meta_keywords),
            'created_by' => Auth::user()->id,
            'status' => $request->status === 'on' ? 1 : 0,
        ];
        $newBrand = Brand::create($data);
        if ($newBrand) {
            return redirect()->route('brands.index')->with('success', 'Category created successfully.');
        } else {
            return redirect()->route('brands.index')->with('error', 'Something went wrong. Please try again.');
        }
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
        $brandById = Brand::find($id);
        $data = [
            'pageTitle' => 'Admin | Edit Brand',
            'brand' => $brandById
        ];
        return view('admin.pages.brand.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'meta_title' => 'required',
        ]);
        $brand = new Brand();
        $updateBrand = $brand->where('id', $id)->update([
            'name' => trim($request->name),
            'slug' => trim($request->slug),
            'meta_title' => trim($request->meta_title),
            'meta_description' => trim($request->meta_description),
            'meta_keywords' => trim($request->meta_keywords),
            'status' => $request->status === 'on' ? 1 : 0,
        ]);
        if ($updateBrand) {
            return redirect()->route('brands.index')->with('success', 'Category updated successfully.');
        } else {
            return redirect()->route('brands.index')->with('error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::find($id);

        $deleteBrand = $brand->update(['is_delete' => 1]);
        if ($deleteBrand) {
            return redirect()->route('brands.index')->with('success', 'Brand deleted successfully.');
        } else {
            return redirect()->route('brands.index')->with('error', 'Something went wrong. Please try again.');
        }
    }
}
