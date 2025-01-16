<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isEmpty;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products   = new Product();
        $products   = $products->getAllProducts();
        foreach ($products as $product) {
            $product->created_by = $product->user->name;
        }
        $data = [
            'pageTitle' => 'Admin | Products',
            'products' => $products
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
        $product->save();

        $slug = Str::slug($title, '-');
        $checkSlug = Product::where('slug', $slug)->count();
        $saveSlug = false;
        if (empty($checkSlug)) {
            $product->slug = $slug;
            $saveSlug = $product->save();
        } else {
            $newSlug = $slug . '-' . $product->id;
            $product->slug = $newSlug;
            $saveSlug = $product->save();
        }

        if ($saveSlug) {
            return redirect()->route('products.edit', $product->id);
        } else {
            return redirect()->route('products.index')->with('error', 'Something went wrong, please try again.');
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
        $product = Product::find($id);
        $categories = Category::where('is_delete', 0)->where('status', 1)->get();
        $brands = Brand::where('is_delete', 0)->where('status', 1)->get();
        $colors = Color::where('is_delete', 0)->where('status', 1)->get();
        $subcategories = [];
        if ($product->category_id != null) {
            $subcategories = Category::find($product->category_id)->subcategories()->get();
        }
        $productImages = $product->images()->count() > 0 ? $product->images()->where('product_id', $id)->orderBy('order_by', 'asc')->get() : [];

        $data = [
            'pageTitle' => 'Admin | Edit Product',
            'product' => $product,
            'categories' => $categories,
            'subcategories' => $subcategories,
            'brands' => $brands,
            'colors' => $colors,
            'productColors' => $product->colors()->where('product_id', $id)->where('is_delete', 0)->where('status', 1)->get(),
            'productSizes' => $product->sizes()->get(),
            'productImages' => $productImages
        ];
        return view('admin.pages.product.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'title' => 'required',
            'sku' => 'required',
            'category' => 'required',
            'subcategory' => 'required',
            'price' => 'required',
            'brand' => 'required',
            'color_id' => 'required',
            'old_price' => 'required',
            'short_description' => 'required',
            'description' => 'required',
            'additional_information' => 'required',
            'shipping_returns' => 'required',
        ]);
        $product = Product::find($id);
        $product->title = trim($request->title);
        $product->sku = trim($request->sku);
        $product->category_id = $request->category;
        $product->sub_category_id = $request->subcategory;
        $product->brand_id = $request->brand;
        $product->old_price = $request->old_price;
        $product->price = $request->price;
        $product->short_description = trim($request->short_description);
        $product->description = trim($request->description);
        $product->additional_information = trim($request->additional_information);
        $product->shipping_returns = trim($request->shipping_returns);
        $product->status = $request->status === 'on' ? 1 : 0;
        if (!empty($request->color_id)) {
            foreach ($request->color_id as $color) {
                $product->colors()->attach($color);
            }
        }
        if (!empty($request->size)) {
            $product->sizes()->delete();
            foreach ($request->size as $size) {
                $product->sizes()->create([
                    'name' => $size['name'],
                    'price' => $size['price']
                ]);
            }
        }
        if (!empty($request->file('image'))) {
            foreach ($request->file('image') as $image) {
                if ($image->isValid()) {
                    $ext = $image->getClientOriginalExtension();
                    $randomStr = $product->id . Str::random(20);
                    $filename = strtolower($randomStr . '.' . $ext);
                    $image->move('upload/product/', $filename);

                    $imageupload = new ProductImage();
                    $imageupload->image_name = $filename;
                    $imageupload->image_extension = $ext;
                    $imageupload->product_id = $product->id;
                    $imageupload->save();
                }
            }
        }
        $updateProduct = $product->save();
        if (!$updateProduct) {
            return redirect()->back()->with('error', 'Something went wrong, please try again.');
        }
        return redirect()->back()->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->update([
            'is_delete' => 1
        ]);
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function deleteImage($id)
    {
        $image = ProductImage::find($id);
        unlink('upload/product/' . $image->image_name);
        $deleteImage = $image->delete();
        if (!$deleteImage) {
            return redirect()->back()->with('error', 'Something went wrong, please try again.');
        }
        return redirect()->back()->with('success', 'Image deleted successfully.');
    }

    public function product_image_sortable(Request $request)
    {
        if (!empty($request->image_id)) {
            $i = 1;
            foreach ($request->image_id as $image_id) {
                $image = ProductImage::find($image_id);
                $image->order_by = $i;
                $image->save();
                $i++;
            }
            $json['success'] = true;
            echo json_encode($json);
        }
    }
}
