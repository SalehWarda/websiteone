<?php

namespace App\Http\Livewire\Admin\Courses;

use App\Models\Backend\Course;
use App\Models\Backend\Service;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Nicolaslopezj\Searchable\SearchableTrait;

class CoursesComponent extends Component
{
    use WithPagination,LivewireAlert,WithFileUploads,SearchableTrait;
    protected $paginationTheme = 'bootstrap';

    public $title_ar;
    public $title_en;
    public $instructor;
    public $deadline;
    public $price;
    public $status;
    public $description_ar;
    public $description_en;
    public $description;
    public $image;
    public $imageDB;
    public $course_id;
    public $course_title;
    public $created_at;

    public $statusS;
    public $keyword;
    public $order_by;
    public $limit_by;


    public function resetData()
    {
        $this->title_ar = null;
        $this->title_en = null;
        $this->instructor = null;
        $this->deadline = null;
        $this->price = null;
        $this->status = null;
        $this->description_ar = null;
        $this->description_en = null;
        $this->image = null;
        $this->imageDB=null;
        $this->course_id = null;
    }

    public function rules()
    {
        return [
            'title_ar' => [Rule::requiredIf(!$this->course_id),'max:255','unique:courses,title->ar,'. $this->course_id],
            'title_en' => [Rule::requiredIf(!$this->course_id),'max:255','unique:courses,title->en,'. $this->course_id],
            'instructor' => ['required'],
            'deadline' => ['required'],
            'price' => ['required'],
            'status' => ['required'],
            'description_ar' => ['required'],
            'description_en' => ['required'],
            'image' => ['mimes:jpeg,jpg,png']
        ];
    }

    protected $messages = [
        'title_ar.required' => 'هذا الحقل لا يجب أن يكون فارغ',
        'title_ar.max' => 'هذا الحقل لا يجب أن يزيد طوله عن 255 حرف',
        'title_ar.unique' => 'هذا الحقل موجود مسبقا',

        'title_en.required' => 'هذا الحقل لا يجب أن يكون فارغ',
        'title_en.max' => 'هذا الحقل لا يجب أن يزيد طوله عن 255 حرف',
        'title_en.unique' => 'هذا الحقل موجود مسبقا',

        'instructor.required' => 'هذا الحقل لا يجب أن يكون فارغ',
        'deadline.required' => 'هذا الحقل لا يجب أن يكون فارغ',
        'price.required' => 'هذا الحقل لا يجب أن يكون فارغ',
        'status.required' => 'هذا الحقل لا يجب أن يكون فارغ',
        'description_ar.required' => 'هذا الحقل لا يجب أن يكون فارغ',
        'description_en.required' => 'هذا الحقل لا يجب أن يكون فارغ',

    ];

    public function modalData()
    {

        $this->emit('createDescription');
        $input['title'] = ['ar' => $this->title_ar, 'en' => $this->title_en];
        $input['title_ar'] =$this->title_ar;
        $input['instructor'] = $this->instructor;
        $input['deadline'] = $this->deadline;
        $input['price'] = $this->price;
        $input['status'] = $this->status;
        $input['description'] = ['ar' => $this->description_ar, 'en' => $this->description_en];

        $course = Course::create($input);

        if($imageC = $this->image){



                $file_name = $course->slug.'_'.time().'_'.'.'.$imageC->getClientOriginalExtension();
                $file_size= $imageC->getSize();
                $file_type = $imageC->getMimeType();
                $path = public_path('/assets/images/admin/courses/'.$file_name);
                Image::make($imageC->getRealPath())->resize(500,null,function ($constraint){
                    $constraint->aspectRatio();
                })->save($path,100);

                $course->firstMedia()->create([
                    'file_name' => $file_name,
                    'file_size' => $file_size,
                    'file_type'=>$file_type,
                    'file_status'=>true,
                    'file_sort'=>1,
                ]);



        }


    }
    public function addCourse()
    {

        $this->validate();
        $this->modalData();
        $this->resetData();
        $this->dispatchBrowserEvent('closeModalAdd');
        $this->alert('success','تم إضافة الدورة بنجاح !');
    }

    public function editCourse($id)
    {
        $this->resetData();
        $this->emit('showDescription');
        $course = Course::with('firstMedia')->whereId($id)->first();


        $this->title_ar = $course->getTranslation('title','ar');
        $this->title_en = $course->getTranslation('title','en');
        $this->instructor = $course->instructor;
        $this->deadline = $course->deadline;
        $this->price = $course->price;
        $this->status = $course->status;
        $this->description_ar = $course->getTranslation('description','ar');
        $this->description_en = $course->getTranslation('description','en');
        $this->course_title = $course->title;
        $this->course_id = $id;
//        $this->image = $course->firstMedia()->file_name;
        $this->imageDB = $course->firstMedia;

    }
    public function updateModalData()
    {

        $course = Course::with('firstMedia')->whereId($this->course_id)->first();
        $input['title'] = ['ar' => $this->title_ar, 'en' => $this->title_en];
        $input['title_ar'] =$this->title_ar;
        $input['instructor'] = $this->instructor;
        $input['deadline'] = $this->deadline;
        $input['price'] = $this->price;
        $input['status'] = $this->status;
        $input['description'] = ['ar' => $this->description_ar, 'en' => $this->description_en];


        $course->update($input);

        if ($this->image) {
            if ($course->firstMedia()->count() > 0) {
                    if (File::exists('assets/images/admin/courses/' . $course->firstMedia->file_name)) {
                        unlink('assets/images/admin/courses/' . $course->firstMedia->file_name);
                    }
                $course->firstMedia()->delete();
            }

            $file_name = $course->slug.'_'.time().'_'.'.'.$this->image->getClientOriginalExtension();
            $file_size= $this->image->getSize();
            $file_type = $this->image->getMimeType();
            $path = public_path('/assets/images/admin/courses/'.$file_name);
            Image::make($this->image->getRealPath())->resize(500,null,function ($constraint){
                $constraint->aspectRatio();
            })->save($path,100);

            $course->firstMedia()->create([
                'file_name' => $file_name,
                'file_size' => $file_size,
                'file_type'=>$file_type,
                'file_status'=>true,
                'file_sort'=>1,
            ]);



        }

    }
    public function updateCourse()
    {

        $this->validate();
        $this->updateModalData();
        $this->resetData();
        $this->dispatchBrowserEvent('closeModalUpdate');
        $this->alert('success','تم تعديل الدورة بنجاح !');
    }


    public function show_delete_course($id)
    {
        $this->resetData();
        $course = Course::where('id',$id)->first();
        $this->course_id = $id;
        $this->course_title= $course->title;

    }

    public function delete_course()
    {
        $course = Course::whereId($this->course_id)->first();
        // dd($course);
        if ($course->firstMedia() != '') {

            if (File::exists('assets/images/admin/courses/' . $course->firstMedia->file_name)) {
                unlink('assets/images/admin/courses/' . $course->firstMedia->file_name);

                $course->firstMedia->delete();
            }
        }

        $course->delete();
        $this->dispatchBrowserEvent('closeModalDeleteC');
        $this->alert('error','تم الحذف بنجاح !');


    }



    public function showCourse($id)
    {
        $this->resetData();
        $course = Course::with('firstMedia')->whereId($id)->first();



        $this->instructor = $course->instructor;
        $this->deadline = $course->deadline;
        $this->price = $course->price;
        $this->status = $course->status;
        $this->description= $course->description;
        $this->course_title = $course->title;
        $this->course_id = $id;
        $this->created_at = $course->created_at->format('Y-M-d');
//        $this->image = $course->firstMedia()->file_name;
        $this->imageDB = $course->firstMedia;

    }

    public function render()
    {
        $courses = Course::with('firstMedia') ->when($this->keyword != null ,function ($query){

            $query->search($this->keyword);
        })
            ->when($this->statusS != null ,function ($query){

                $query->whereStatus($this->statusS);
            })
            ->orderBy( 'id' , $this->order_by ?? 'desc')
            ->paginate($this->limit_by ?? 10);
        return view('livewire.admin.courses.courses-component',[

            'courses' => $courses
        ]);
    }
}
