<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Backend\Admin;
use App\Models\Backend\Coupon;
use App\Models\Backend\Course;
use App\Models\Backend\Mail;
use App\Models\Backend\Post;
use App\Models\Backend\Service;
use App\Models\Backend\Video;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $data['services'] = Service::all();
        $data['posts'] = Post::all();
        $data['courses'] = Course::all();
        $data['videos'] = Video::all();
        $data['admins'] = Admin::all();
        $data['mails'] = Mail::all();
        $data['coupons'] = Coupon::all();
        $data['users'] = User::all();
        $data['visits'] = DB::table('visits')->select('ip')->count();
        return view('pages.admin.index',$data);
    }
}
