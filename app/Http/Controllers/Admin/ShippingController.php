<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ShippingCharge;
use App\Http\Controllers\Controller;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pageTitle'] = 'Admin | Shipping';
        $data['shippingCharges'] = ShippingCharge::where('is_delete', 0)->paginate(10);

        return view('admin.pages.shipping.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['pageTitle'] = 'Admin | Create Shipping Charge';
        return view('admin.pages.shipping.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        $newShippingCharge = ShippingCharge::create([
            'name' => $request->name,
            'price' => $request->price,
            'status' => $request->status == 'on' ? 1 : 0
        ]);

        if ($newShippingCharge) {
            return redirect()->route('shipping.index')->with('success', 'Shipping charge created successfully.');
        } else {
            return redirect()->route('shipping.index')->with('error', 'Something went wrong. Please try again.');
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
            'pageTitle' => 'Admin | Edit Shipping Charge',
            'shippingCharge' => ShippingCharge::find($id),
        ];
        return view('admin.pages.shipping.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',

        ]);

        $updateShippingCharge = ShippingCharge::find($id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'status' => $request->status == 'on' ? 1 : 0
        ]);

        if ($updateShippingCharge) {
            return redirect()->route('shipping.index')->with('success', 'Shipping charge updated successfully.');
        } else {
            return redirect()->route('shipping.index')->with('error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleteShippingCharge = ShippingCharge::find($id)->update([
            'is_delete' => 1
        ]);

        if ($deleteShippingCharge) {
            return redirect()->route('shipping.index')->with('success', 'Shipping charge deleted successfully.');
        } else {
            return redirect()->route('shipping.index')->with('error', 'Something went wrong. Please try again.');
        }
    }
}
