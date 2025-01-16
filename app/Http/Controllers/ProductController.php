<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($slug = '', $subslug = '')
    {
        $getCategory = Category::where('slug', $slug)->first();
        $getDetailProduct = Product::where('slug', $slug)->first();
        $getSubcategory = Subcategory::where('slug', $subslug)->first();
        if (!empty($getDetailProduct)) {
            $data['meta_title'] = $getDetailProduct->title;
            $data['product'] = $getDetailProduct;
            $data['relatedProducts'] = Product::where('slug', '!=', $getDetailProduct->slug)->where('category_id', $getDetailProduct->category_id)->where('is_delete', 0)->where('status', 1)->limit(10)->get();
            return view('product.show', $data);
        }
        if (!empty($getCategory) && !empty($getSubcategory)) {
            $data['subcategoriesFilter'] = Category::find($getCategory->id)->subcategories()->where('is_delete', 0)->where('status', 1)->get();
            foreach ($data['subcategoriesFilter'] as $value) {
                $value['totalProduct'] = Product::where('sub_category_id', $value['id'])->where('is_delete', 0)->where('status', 1)->count();
            }
            $data['colorsFilter'] = Color::where('is_delete', 0)->where('status', 1)->get();
            $data['brandsFilter'] = Product::getBrandFilter($getCategory->id);

            $data['meta_title'] = $getSubcategory->name;
            $data['meta_description'] = $getSubcategory->meta_description;
            $data['meta_keywords'] = $getSubcategory->meta_keywords;

            $data['getCategory'] = $getCategory;
            $data['getSubcategory'] = $getSubcategory;
            $data['products'] = Product::getProductForFrontend($getCategory->id, $getSubcategory->id);
            return view('product.index', $data);
        }
        if (!empty($getCategory)) {
            $data['subcategoriesFilter'] = Category::find($getCategory->id)->subcategories()->where('is_delete', 0)->where('status', 1)->get();
            $data['colorsFilter'] = Color::where('is_delete', 0)->where('status', 1)->get();
            $data['brandsFilter'] = Product::getBrandFilter($getCategory->id);

            $data['meta_title'] = $getCategory->name;
            $data['meta_description'] = $getCategory->meta_description;
            $data['meta_keywords'] = $getCategory->meta_keywords;
            $data['getCategory'] = $getCategory;

            $data['products'] = Product::getProductForFrontend($getCategory->id);
            return view('product.index', $data);
        } else {
            abort(404);
        }
    }
    public function getFilteredProducts(Request $request)
    {
        $products = Product::getProductForFrontend();
        return response()->json([
            'status' => true,
            'success' => view('product._listProduct', [
                'products' => $products
            ])->render(),
        ], 200);
    }
    public function searchProduct(Request $request)
    {
        if (!empty($request->get('q'))) {
            $data['meta_title'] = 'Search';
            $data['meta_description'] = '';
            $data['meta_keywords'] = '';

            $data['products'] = Product::where('title', 'like', '%' . $request->get('q') . '%')->paginate(10);
            return view('product.index', $data);
        }
    }
}
