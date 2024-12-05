<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $data = [
            'pageTitle' => 'Admin | Dashboard'
        ];

        return view('admin.pages.dashboard', $data);
    }
    public function adminList()
    {
        $data = [
            'pageTitle' => 'Admin | Admin List'
        ];
        return view('admin.pages.admin-list', $data);
    }
    public function product()
    {
        $data = [
            'pageTitle' => 'Admin | Product'
        ];
        return view('admin.pages.product', $data);
    }
}
