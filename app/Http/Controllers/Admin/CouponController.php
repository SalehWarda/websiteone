<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CouponRequest;
use App\Models\Backend\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{

    public function index()
    {
        //
        $coupons = Coupon::orderBy('id','DESC')->paginate(10);

        return view('pages.admin.coupons.index',compact('coupons'));
    }


    public function create()
    {
        //
    }


    public function store(CouponRequest $request)
    {

        Coupon::create($request->validated());

        return redirect()->back();
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(CouponRequest  $request)
    {
        $coupon = Coupon::findOrFail($request->coupon_id);
        $coupon->update($request->validated());

        return redirect()->back();
    }


    public function destroy(Request $request)
    {

        $coupon = Coupon::findOrFail($request->coupon_id);
        $coupon->delete();

        return redirect()->back();
    }
}
