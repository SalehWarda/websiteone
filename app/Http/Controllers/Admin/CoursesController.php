<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Vimeo\Laravel\VimeoManager;

class CoursesController extends Controller
{
    //
    public function index()
    {
        return view('pages.admin.courses.index');
    }


}
