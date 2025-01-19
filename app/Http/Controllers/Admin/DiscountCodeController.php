<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiscountCode;
use Illuminate\Http\Request;

class DiscountCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'pageTitle' => 'Admin | Discount Coupons',
            'coupons' => DiscountCode::where('is_delete', 0)->paginate(10)
        ];
        return view('admin.pages.discount.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'pageTitle' => 'Admin | Create Discount Coupon',

        ];
        return view('admin.pages.discount.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required|in:amount,percent',
            'percent_amount' => 'required|numeric',
            'expire_date' => 'required',
        ]);
        $newCoupon = DiscountCode::create([
            'name' => $request->name,
            'type' => $request->type,
            'percent_amount' => $request->percent_amount,
            'expire_date' => $request->expire_date,
            'status' => $request->status ? 1 : 0,
        ]);
        if ($newCoupon) {
            return redirect()->route('discount-codes.index')->with('success', 'Coupon created successfully.');
        } else {
            return redirect()->route('discount-codes.index')->with('error', 'Something went wrong. Please try again.');
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
            'pageTitle' => 'Admin | Edit Discount Coupon',
            'coupon' => DiscountCode::find($id),
        ];
        return view('admin.pages.discount.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required|in:amount,percent',
            'percent_amount' => 'required|numeric',
            'expire_date' => 'required',
        ]);
        $updateCoupon = DiscountCode::find($id)->update([
            'name' => $request->name,
            'type' => $request->type,
            'percent_amount' => $request->percent_amount,
            'expire_date' => $request->expire_date,
            'status' => $request->status ? 1 : 0,
        ]);
        if ($updateCoupon) {
            return redirect()->route('discount-codes.index')->with('success', 'Coupon updated successfully.');
        } else {
            return redirect()->route('discount-codes.index')->with('error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleteCoupon = DiscountCode::find($id)->update([
            'is_delete' => 1
        ]);
        if ($deleteCoupon) {
            return redirect()->route('discount-codes.index')->with('success', 'Coupon deleted successfully.');
        } else {
            return redirect()->route('discount-codes.index')->with('error', 'Something went wrong. Please try again.');
        }
    }
}
