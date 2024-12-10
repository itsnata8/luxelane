<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = new Category();
        $categories = $category->getAllCategories();
        foreach ($categories as $category) {
            $category->created_by = $category->user->name;
        }
        $data = [
            'pageTitle' => 'Admin | Category',
            'categories' => $categories
        ];
        return view('admin.pages.category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'pageTitle' => 'Admin | Create Category'
        ];
        return view('admin.pages.category.create', $data);
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
        $newCategory = Category::create($data);
        if ($newCategory) {
            return redirect()->route('categories.index')->with('success', 'Category created successfully.');
        } else {
            return redirect()->route('categories.index')->with('error', 'Something went wrong. Please try again.');
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
        $categoryById = $category->getCategoryById($id);
        $data = [
            'pageTitle' => 'Admin | Edit Category',
            'category' => $categoryById
        ];
        return view('admin.pages.category.edit', $data);
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
        $category = new Category();
        $updateCategory = $category->where('id', $id)->update([
            'name' => trim($request->name),
            'slug' => trim($request->slug),
            'meta_title' => trim($request->meta_title),
            'meta_description' => trim($request->meta_description),
            'meta_keywords' => trim($request->meta_keywords),
            'status' => $request->status === 'on' ? 1 : 0,
        ]);
        if ($updateCategory) {
            return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
        } else {
            return redirect()->route('categories.index')->with('error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = new Category();
        $deleteCategory = $category->where('id', $id)->update(['is_delete' => 1]);
        if ($deleteCategory) {
            return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
        } else {
            return redirect()->route('categories.index')->with('error', 'Something went wrong. Please try again.');
        }
    }
}
