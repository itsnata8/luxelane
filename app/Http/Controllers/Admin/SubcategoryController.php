<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategory = new Subcategory();
        $subcategories = $subcategory->getAllSubcategories();
        // get category name
        foreach ($subcategories as $subcategory) {
            $subcategory->created_by = $subcategory->user->name;
            $subcategory->category_id = $subcategory->category->name;
        }
        $data = [
            'pageTitle' => 'Admin | Subcategory',
            'subcategories' => $subcategories
        ];
        return view('admin.pages.subcategory.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = new Category();
        $categories = $category->getAllCategories();
        $data = [
            'pageTitle' => 'Admin | Create Subcategory',
            'categories' => $categories
        ];
        return view('admin.pages.subcategory.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'slug' => 'required|unique:subcategories,slug',
            'meta_title' => 'required',
        ]);
        $data = [
            'name' => trim($request->name),
            'category_id' => $request->category_id,
            'slug' => trim($request->slug),
            'meta_title' => trim($request->meta_title),
            'meta_description' => trim($request->meta_description),
            'meta_keywords' => trim($request->meta_keywords),
            'created_by' => Auth::user()->id,
            'status' => $request->status === 'on' ? 1 : 0,
        ];
        $newSubcategory = Subcategory::create($data);
        if ($newSubcategory) {
            return redirect()->route('subcategories.index')->with('success', 'Subcategory created successfully.');
        } else {
            return redirect()->route('subcategories.index')->with('error', 'Something went wrong. Please try again.');
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
        $category = new Category();
        $categories = $category->getAllCategories();
        $data = [
            'pageTitle' => 'Admin | Subcategory',
            'subcategory' => Subcategory::find($id),
            'categories' => $categories
        ];
        return view('admin.pages.subcategory.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'slug' => 'required',
            'meta_title' => 'required',
        ]);
        $updateSubcategory = Subcategory::find($id)->update([
            'category_id' => $request->category_id,
            'name' => trim($request->name),
            'slug' => trim($request->slug),
            'meta_title' => trim($request->meta_title),
            'meta_description' => trim($request->meta_description),
            'meta_keywords' => trim($request->meta_keywords),
            'status' => $request->status === 'on' ? 1 : 0,
        ]);
        if ($updateSubcategory) {
            return redirect()->route('subcategories.index')->with('success', 'Subcategory updated successfully.');
        } else {
            return redirect()->route('subcategories.index')->with('error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleteSubcategory = Subcategory::find($id)->update([
            'is_delete' => 1
        ]);
        if ($deleteSubcategory) {
            return redirect()->route('subcategories.index')->with('success', 'Subcategory deleted successfully.');
        } else {
            return redirect()->route('subcategories.index')->with('error', 'Something went wrong. Please try again.');
        }
    }
}
