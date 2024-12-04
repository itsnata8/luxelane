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
}
