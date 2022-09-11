<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Livewire\Site\Customer\Order;
use App\Http\Requests\Site\ProfileRequest;
use App\Models\Backend\Course;
use App\Models\Backend\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use function Clue\StreamFilter\fun;

class CustomerController extends Controller
{
    //
    public function profile()
    {
        $courses = Course::whereHas('orders',function ($query){

            $query->where('user_id',auth('web')->id());

        })->get();


        return view('pages.site.customer.profile',compact('courses'));
    }

    public function courses()
    {
        $courses = Course::whereHas('orders',function ($query){

           $query->where('user_id',auth('web')->id());

        })->get();





        return view('pages.site.customer.myCourses',compact('courses'));
    }

     public function courseVideos($id)
    {
        $course = Course::with('videos')->find($id);



        return view('pages.site.customer.courseVideos',compact('course'));
    }

    public function videos($course_id,$video_id)
    {
//        $videos = Course::whereHas('videos',function ($query) use($video_id){
//
//            $query->where('id',$video_id);
//
//        })->get();


        $course = Course::with('videos')->findOrFail($course_id);
        $video = Video::with('course')->find($video_id);

        return view('pages.site.customer.courseVideosTot',compact('video','course'));
    }

    public function update_profile(ProfileRequest $request)
    {
        $user = auth()->user();
        $data['first_name'] = $request->first_name;
        $data['last_name'] = $request->last_name;
        $data['email'] = $request->email;
        $data['mobile'] = $request->mobile;

        if (!empty($request->password) && !Hash::check($request->password, $user->password)) {
            $data['password'] = bcrypt($request->password);
        }

        if ($user_image = $request->file('user_image')) {
            if ($user->user_image != '') {
                if (File::exists('assets/images/customer/' . $user->user_image)){
                    unlink('assets/images/customer/' . $user->user_image);
                }
            }

            $file_name = $user->username . '.' . $user_image->extension();
            $path = public_path('assets/images/customer/'. $file_name);
            Image::make($user_image->getRealPath())->resize(300, null, function ($constraints) {
                $constraints->aspectRatio();
            })->save($path, 100);
            $data['user_image'] = $file_name;
        }

        $user->update($data);

        toastr('Profile updated', 'success');
        return back();
    }
    public function remove_profile_image()
    {
        $user = auth()->user();
        if ($user->user_image != '') {
            if (File::exists('assets/images/customer/' . $user->user_image)){
                unlink('assets/images/customer/' . $user->user_image);
            }
        }
        $user->user_image = null;
        $user->save();
        toastr('Profile image deleted', 'success');
        return back();
    }

}
