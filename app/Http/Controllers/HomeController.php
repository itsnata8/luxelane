<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'categories' => Category::all()->where('is_delete', 0),
            'meta_title' => 'LuxeLane | E-commerce',
            'meta_description' => '',
            'meta_keywords' => '',
        ];
        return view('home', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
}
