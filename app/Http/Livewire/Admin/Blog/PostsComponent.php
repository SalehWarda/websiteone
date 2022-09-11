<?php

namespace App\Http\Livewire\Admin\Blog;

use App\Models\Backend\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Nicolaslopezj\Searchable\SearchableTrait;

class PostsComponent extends Component
{
    use WithPagination,LivewireAlert,WithFileUploads,SearchableTrait;
    protected $paginationTheme = 'bootstrap';
    public $title;
    public $title_ar;
    public $title_en;
    public $content;
    public $content_ar;
    public $content_en;
    public $status;
    public $created_by;
    public $date_of_publication;
    public $images =[];
    public $imagesDB;
    public $post_id;

    public $statusS;
    public $keyword;
    public $order_by;
    public $limit_by;




    public function resetData()
    {
        $this->title_ar = null;
        $this->title_en = null;
        $this->content_ar = null;
        $this->content_en = null;
        $this->status = null;
        $this->date_of_publication = null;
        $this->images = null;
        $this->imagesDB = null;
    }

    public function rules()
    {
        return [
            'title_ar' => [Rule::requiredIf(!$this->post_id),'max:255','unique:posts,title->ar,'. $this->post_id],
            'title_en' => [Rule::requiredIf(!$this->post_id),'max:255','unique:posts,title->en,'. $this->post_id],
            'content_ar' => ['nullable'],
            'content_en' => ['nullable'],
            'status' => ['required'],
            'date_of_publication' => ['required_if:status,0'],
            'images' => [Rule::requiredIf(!$this->post_id),'max:4']
        ];
    }

    protected $messages = [
        'title_ar.required' => 'هذا الحقل لا يجب أن يكون فارغ',
        'title_ar.max' => 'هذا الحقل لا يجب أن يزيد طوله عن 255 حرف',
        'title_ar.unique' => 'هذا الحقل موجود مسبقا',

        'title_en.required' => 'هذا الحقل لا يجب أن يكون فارغ',
        'title_en.max' => 'هذا الحقل لا يجب أن يزيد طوله عن 255 حرف',
        'title_en.unique' => 'هذا الحقل موجود مسبقا',

        'status.required' => 'هذا الحقل لا يجب أن يكون فارغ',
        'date_of_publication.required_if' => 'هذا الحقل مطلوب عندما تكون حالة المنشور غير نشط',
        'images.required' => 'هذا الحقل لا يجب أن يكون فارغ',
        'images.max' => 'لا يمكنك تحميل أكثر من 4 صور للمنشور الواحد',

    ];

    public function modalData()
    {

        $this->emit('createContent');
        $input['title'] = ['ar' => $this->title_ar, 'en' => $this->title_en];
        $input['title_ar'] = $this->title_ar;
        $input['content'] = ['ar' => $this->content_ar, 'en' => $this->content_en];
        $input['created_by'] = auth('admin')->user()->name;
        $input['status'] = $this->status;
        $input['date_of_publication'] = Carbon::parse( $this->date_of_publication)->format('Y-m-d H:i');



        $post = Post::create($input);

        if($this->images && count($this->images) > 0){
            $i=1;
            foreach ($this->images as $image){

                $file_name = $post->slug.'_'.time().'_'.$i.'.'.$image->getClientOriginalExtension();
                $file_size= $image->getSize();
                $file_type = $image->getMimeType();
                $path = public_path('/assets/images/admin/posts/'.$file_name);
                Image::make($image->getRealPath())->resize(500,null,function ($constraint){
                    $constraint->aspectRatio();
                })->save($path,100);

                $post->media()->create([
                    'file_name' => $file_name,
                    'file_size' => $file_size,
                    'file_type'=>$file_type,
                    'file_status'=>true,
                    'file_sort'=>$i,
                ]);
                $i++;

            }
        }

    }
    public function addPost()
    {
        $this->validate();
        $this->modalData();
        $this->resetData();
        $this->dispatchBrowserEvent('closeModalAdd');
        $this->alert('success','تم إضافة البوست بنجاح !');
    }


    public function editPost($id)
    {
        $this->resetData();
        $this->emit('showContent');
        $post = Post::whereId($id)->first();
        $this->title_ar = $post->getTranslation('title','ar');
        $this->title_en = $post->getTranslation('title','en');
        $this->status = $post->status;
        $this->content_ar = $post->getTranslation('content','ar');
        $this->content_en = $post->getTranslation('content','en');
        $this->title = $post->title;
        $this->date_of_publication = Carbon::parse( $post->date_of_publication)->format('Y-m-d H:i');
        $this->post_id = $id;
        $this->imagesDB = $post->media;

    }
    public function updateModalData()
    {

        $post = Post::whereId($this->post_id)->first();
        $input['title'] = ['ar' => $this->title_ar, 'en' => $this->title_en];
        $input['title_ar'] = $this->title_ar;
        $input['content'] = ['ar' => $this->content_ar, 'en' => $this->content_en];
        $input['created_by'] = auth('admin')->user()->name;
        $input['status'] = $this->status;
        $input['date_of_publication'] = Carbon::parse( $this->date_of_publication)->format('Y-m-d H:i');


        $post->update($input);

        if ($this->images && count($this->images) > 0) {
//            if ($post->media()->count() > 0) {
//                foreach ($post->media as $media) {
//                    if (File::exists('assets/images/admin/posts/' . $media->file_name)) {
//                        unlink('assets/images/admin/posts/' . $media->file_name);
//                    }
//                    $media->delete();
//                }
//            }

                $i = $post->media()->count() + 1;
                foreach ($this->images as $image) {
                    $file_name = $post->slug. '_' . time() . '_' . $i . '.' . $image->getClientOriginalExtension();
                    $file_size = $image->getSize();
                    $file_type = $image->getMimeType();
                    $path = public_path('/assets/images/admin/posts/' . $file_name);

                    Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path, 100);

                    $post->media()->create([
                        'file_name' => $file_name,
                        'file_size' => $file_size,
                        'file_type' => $file_type,
                        'file_status' => true,
                        'file_sort' => $i,
                    ]);
                    $i++;
                }

        }

    }
    public function updatePost()
    {

        $this->validate();
        $this->updateModalData();
        $this->resetData();
        $this->dispatchBrowserEvent('closeModalUpdate');
        $this->alert('success','تم تعديل البوست بنجاح !');
    }


    public function show_delete_post($id)
    {
        $this->resetData();
        $post = Post::whereId($id)->first();
        $this->post_id = $id;
        $this->title = $post->title;

    }

    public function deletePost()
    {
        $post = Post::whereId($this->post_id)->first();

        if ($post->media()->count() > 0){

            foreach ($post->media as $media){

                if (File::exists('assets/images/admin/posts/' . $media->file_name)) {

                    unlink('assets/images/admin/posts/' . $media->file_name);

                }
                $media->delete();

            }
        }

        $post->delete();
        $this->dispatchBrowserEvent('closeModalDelete');
        $this->alert('error','تم الحذف بنجاح !');


    }

    public function render()
    {

        $posts = Post::with('firstMedia')
            ->when($this->keyword != null ,function ($query){

            $query->search($this->keyword);
        })
            ->when($this->statusS != null ,function ($query){

                $query->whereStatus($this->statusS);
            })
            ->orderBy( 'id' , $this->order_by ?? 'desc')
            ->paginate($this->limit_by ?? 10);











        return view('livewire.admin.blog.posts-component',[


            'posts' => $posts,
        ]);
    }
}
