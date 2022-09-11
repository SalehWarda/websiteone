<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function index(Request $request)
    {
//        $data = Admin::orderBy('id','DESC')->paginate(5);
        return view('pages.admin.customers.index');
//            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

}
