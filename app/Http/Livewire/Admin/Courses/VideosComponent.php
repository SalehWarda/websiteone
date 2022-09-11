<?php

namespace App\Http\Livewire\Admin\Courses;

use App\Jobs\ConvertVideoForStreaming;
use App\Jobs\CreateThumbnailFromVideo;
use App\Models\Backend\Course;
use App\Models\Backend\Video;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Nicolaslopezj\Searchable\SearchableTrait;
use phpDocumentor\Reflection\Types\This;

class VideosComponent extends Component
{
    use WithPagination,LivewireAlert,WithFileUploads,SearchableTrait;
    protected $paginationTheme = 'bootstrap';

    // Video Section
    public $course;
    public $video;
    public $title;
    public $description;
    public $visibility;
    public $fileVideo;
    public $video_id;
    public $thumbnail;
    public $processed_file;
    public $uid;




    public function resetData()
    {

        $this->title = null;
        $this->description = null;
        $this->visibility = null;
        $this->thumbnail = null;
        $this->processed_file = null;
        $this->video_id = null;
        $this->uid = null;

    }

    public function rules()
    {
        return [

            'title' => ['required'],
            'description' => ['nullable'],
            'visibility' => ['required'],
            'fileVideo' => ['required','mimes:mp4']
        ];
    }


    public function fileCompleted()
    {
        // dd($this->validate());
        $this->validate();
        $path = $this->fileVideo->store('video-temp');
        $this->emit('createDescription');
        $input['title'] = $this->title;
        $input['description'] = $this->description;
        $input['visibility'] = $this->visibility;
        $input['uid'] = uniqid(true);
        $input['path'] = explode('/',$path)[1];

        $this->video = $this->course->videos()->create($input);


        //dispatch jobs
        CreateThumbnailFromVideo::dispatch($this->video);
        ConvertVideoForStreaming::dispatch($this->video);



        $this->resetData();
        $this->dispatchBrowserEvent('closeModalAdd');
        $this->alert('success','تم إضافة الفيديو بنجاح !');


    }


    public function editVideo($id)
    {
        $this->resetData();
        $this->emit('showDescription');
        $video = Video::whereId($id)->first();

        $this->title = $video->title;
        $this->visibility = $video->visibility;
        $this->description = $video->description;
        $this->video_id = $id;
        $this->thumbnail = $video->thumbnail;

    }
    public function updateModalData()
    {

        $video = Video::whereId($this->video_id)->first();
        $input['title'] = $this->title;
        $input['description'] = $this->description;
        $input['visibility'] = $this->visibility;

        $video->update($input);

    }
    public function updateVideo()
    {
//        $this->validate();
        $this->emit('showDescription');
        $this->updateModalData();
        $this->resetData();
        $this->dispatchBrowserEvent('closeModalUpdate');
        $this->alert('success','تم تعديل الفيديو بنجاح !');
    }


    public function show_delete_video($id)
    {
        $this->resetData();
        $video = Video::where('id',$id)->first();
        $this->video_id = $id;
        $this->title= $video->title;

    }

    public function delete_video()
    {
        $video = Video::whereId($this->video_id)->first();

        $deleted = Storage::disk('videos')->deleteDirectory($video->uid);

        if ($deleted){
            $video->delete();

        }

        $this->dispatchBrowserEvent('closeModalDelete');
        $this->alert('error','تم الحذف بنجاح !');


    }

//    public function showVideo($id)
//    {
//        $this->resetData();
//        $video = Video::whereId($id)->first();
//
//        $this->title = $video->title;
//        $this->video_id = $video->id;
//        $this->processed_file = $video->video;
//        $this->uid = $video->uid;
//    }
    public function render()
    {

        return view('livewire.admin.courses.videos-component',[
            'videos' => $this->course->videos()->orderBy('id','DESC')->paginate(10)
        ]);
    }


}
