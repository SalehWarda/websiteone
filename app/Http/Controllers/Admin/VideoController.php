<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Backend\Course;
use App\Models\Backend\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{

    public function index($id)
    {
        $course = Course::with('videos')->findOrFail($id);
        return view('pages.admin.courses.videos',compact('course'));
    }


    public function watch($id)
    {
        //
        $video = Video::whereId($id)->first();
        return view('pages.admin.courses.watch_video',compact('video'));
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
