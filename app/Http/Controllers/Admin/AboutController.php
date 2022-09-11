<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AboutRequest;
use App\Models\Backend\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class AboutController extends Controller
{

    //
    public function index()
    {
        $about = AboutUs::first();
        return view('pages.admin.about.about',compact('about'));
    }

    public function update(AboutRequest $request)
    {


        $about = AboutUs::whereId($request->about_id)->firstOrFail();
      $input['name'] = ['ar' => $request->name_ar, 'en' => $request->name_en];
      $input['address'] = ['ar' => $request->address_ar, 'en' => $request->address_en];
      $input['email'] =  $request->email;
      $input['mobile'] =  $request->mobile;
      $input['degree'] = ['ar' => $request->degree_ar, 'en' => $request->degree_en];
      $input['bio'] = ['ar' => $request->bio_ar, 'en' => $request->bio_en];
      $input['education'] = ['ar' => $request->education_ar, 'en' => $request->education_en];
      $input['experiences'] = ['ar' => $request->experiences_ar, 'en' => $request->experiences_en];
      $input['goals'] = ['ar' => $request->goals_ar, 'en' => $request->goals_en];


        if( $request->image){

            if ($about->image != '' && File::exists('assets/images/admin/about/' . $about->image)) {

                    unlink('assets/images/admin/about/' . $about->image);

            }
            $file_name = $about->id.'_'.time().'_'.'.'.$request->image->getClientOriginalExtension();

            $path = public_path('/assets/images/admin/about/'.$file_name);
            Image::make($request->image->getRealPath())->resize(500,null,function ($constraint){
                $constraint->aspectRatio();
            })->save($path,100);

            $input['image'] = $file_name;
        }
        if( $request->cover_image){

            if ($about->cover_image != '' && File::exists('assets/images/admin/about/' . $about->cover_image)) {

                    unlink('assets/images/admin/about/' . $about->cover_image);

            }
            $file_name = $about->id.'_'.time().'_'.'.'.$request->cover_image->getClientOriginalExtension();

            $path = public_path('/assets/images/admin/about/'.$file_name);
            Image::make($request->cover_image->getRealPath())->resize(500,null,function ($constraint){
                $constraint->aspectRatio();
            })->save($path,100);

            $input['cover_image'] = $file_name;
        }



        $about->update($input);

        toastr()->success('تم التعديل بنجاح !');

        return redirect()->back();
    }
}
