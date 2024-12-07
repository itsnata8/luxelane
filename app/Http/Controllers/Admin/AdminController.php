<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'pageTitle' => 'Admin | Admin List',
            'admins' => User::getAllAdmins()
        ];
        return view('admin.pages.admin.admin-list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $data = [
            'pageTitle' => 'Admin | Create Admin'
        ];
        return view('admin.pages.admin.create-admin', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|max:45',
        ]);

        $creds = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => 1,
            'is_active' => $request->status == 'on' ? 1 : 0,
        ];
        $newAdmin = User::create($creds);

        if ($newAdmin) {
            return redirect()->route('admin.index')->with('success', 'Admin created successfully.');
        } else {
            return redirect()->route('admin.index')->with('error', 'Something went wrong. Please try again.');
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
        $data = [
            'pageTitle' => 'Admin | Edit Admin',
            'admin' => User::getAdminById($id)
        ];
        return view('admin.pages.admin.edit-admin', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'min:8|max:45|nullable',
        ]);
        $creds = [
            'name' => $request->name,
            'email' => $request->email,
            'is_active' => $request->status === 'on' ? 1 : 0,
        ];
        if ($request->password !== null) {
            $creds = [...$creds, 'password' => $request->password];
        }
        $updateUser = User::getAdminById($id)->update($creds);
        if ($updateUser) {
            return redirect()->route('admin.index')->with('success', 'Admin updated successfully.');
        } else {
            return redirect()->route('admin.index')->with('error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = User::getAdminById($id);
        $admin->update(['is_delete' => 1]);
        return redirect()->route('admin.index')->with('success', 'Admin deleted successfully.');
    }
}
