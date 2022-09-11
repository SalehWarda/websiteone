<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CoverRequest;
use App\Models\Backend\Cover;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class CoverController extends Controller
{
    public function index()
    {
        $cover = Cover::first();
        return view('pages.admin.cover.cover',compact('cover'));
    }


    public function update(CoverRequest $request)
    {


        $cover = Cover::whereId($request->cover_id)->firstOrFail();
        $input['field_one'] = ['ar' => $request->field_one_ar, 'en' => $request->field_one_en];
        $input['field_tow'] = ['ar' => $request->field_tow_ar, 'en' => $request->field_tow_en];
        $input['field_three'] =  ['ar' => $request->field_three_ar, 'en' => $request->field_three_en];
        $input['title'] =  ['ar' => $request->title_ar, 'en' => $request->title_en];

        if( $request->cover_image){

            if ($cover->cover_image != '' && File::exists('assets/images/admin/cover/' . $cover->cover_image)) {

                unlink('assets/images/admin/cover/' . $cover->cover_image);

            }
            $file_name = $cover->id.'_'.time().'_'.'.'.$request->cover_image->getClientOriginalExtension();

            $path = public_path('/assets/images/admin/cover/'.$file_name);
            Image::make($request->cover_image->getRealPath())->resize(500,null,function ($constraint){
                $constraint->aspectRatio();
            })->save($path,100);

            $input['cover_image'] = $file_name;
        }

        if( $request->icon){

            if ($cover->icon != '' && File::exists('assets/images/admin/cover/' . $cover->icon)) {

                unlink('assets/images/admin/cover/' . $cover->icon);

            }
            $file_name = $cover->id.'_'.time().'_'.'.'.$request->icon->getClientOriginalExtension();

            $path = public_path('/assets/images/admin/cover/'.$file_name);
            Image::make($request->icon->getRealPath())->resize(500,null,function ($constraint){
                $constraint->aspectRatio();
            })->save($path,100);

            $input['icon'] = $file_name;
        }

        $cover->update($input);

        toastr()->success('تم التعديل بنجاح !');

        return redirect()->back();
    }
}
