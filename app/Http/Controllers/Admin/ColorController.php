<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Support\Facades\Auth;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $color = new Color();
        $colors = $color->getAllColors();
        foreach ($colors as $color) {
            $color->created_by = $color->user->name;
        }
        $data = [
            'pageTitle' => 'Admin | Color',
            'colors'    => $colors
        ];
        return view('admin.pages.color.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'pageTitle' => 'Admin | Create Color',
        ];
        return view('admin.pages.color.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required|unique:colors,code',
        ]);
        $data = [
            'name' => trim($request->name),
            'code' => trim($request->code),
            'created_by' => Auth::user()->id,
            'status' => $request->status === 'on' ? 1 : 0,
        ];
        $newColor = Color::create($data);
        if ($newColor) {
            return redirect()->route('colors.index')->with('success', 'Color created successfully.');
        } else {
            return redirect()->route('colors.index')->with('error', 'Something went wrong. Please try again.');
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
        $colorById = Color::find($id);
        $data = [
            'pageTitle' => 'Admin | Edit Color',
            'color' => $colorById
        ];
        return view('admin.pages.color.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
        ]);
        $color = new Color();
        $updateColor = $color->where('id', $id)->update([
            'name' => trim($request->name),
            'code' => trim($request->code),
            'status' => $request->status === 'on' ? 1 : 0,
        ]);
        if ($updateColor) {
            return redirect()->route('colors.index')->with('success', 'Color updated successfully.');
        } else {
            return redirect()->route('colors.index')->with('error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $color = Color::find($id);

        $deleteColor = $color->update(['is_delete' => 1]);
        if ($deleteColor) {
            return redirect()->route('colors.index')->with('success', 'Color deleted successfully.');
        } else {
            return redirect()->route('colors.index')->with('error', 'Something went wrong. Please try again.');
        }
    }
}
