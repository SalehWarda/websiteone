<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PaymentMethodRequest;
use App\Models\Backend\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function index()
    {


        $payment_methods = PaymentMethod::query()
            ->when(\request()->keyword != '', function ($q){
                $q->search(\request()->keyword);
            })
            ->when(\request()->status != '', function ($q){
                $q->whereStatus(\request()->status);
            })
            ->orderBy(\request()->sort_by ?? 'id', \request()->order_by ?? 'desc')
            ->paginate(\request()->limit_by ?? 10);
        return view('pages.admin.payment_methods.index', compact('payment_methods'));
    }

    public function create()
    {


        return view('pages.admin.payment_methods.create');
    }

    public function store(PaymentMethodRequest $request)
    {


        PaymentMethod::create($request->validated());
        toastr()->success('تم الإضافة بنجاح!');

        return redirect()->route('admin.payment_methods.index');

    }

    public function edit($id)
    {


        $payment_method = PaymentMethod::findOrFail($id);
        return view('pages.admin.payment_methods.edit',compact('payment_method'));
    }

    public function update(PaymentMethodRequest $request)
    {

        $payment_method = PaymentMethod::findOrFail($request->payment_id);
        $payment_method->update($request->validated());

        toastr()->success('تم التعديل بنجاح!');
        return redirect()->route('admin.payment_methods.index');
    }

    public function destroy(Request $request)
    {
        $payment_method = PaymentMethod::findOrFail($request->payment_id);
        $payment_method->delete();

        toastr()->error('تم الحذف بنجاح!');
        return redirect()->route('admin.payment_methods.index');
    }
}
