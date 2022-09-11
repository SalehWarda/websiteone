<?php

namespace App\Http\Livewire\Admin\Profile;

use App\Models\Backend\Admin;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Intervention\Image\Facades\Image;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Nicolaslopezj\Searchable\SearchableTrait;

class ProfileComponent extends Component
{
    use WithPagination,LivewireAlert,WithFileUploads,SearchableTrait;
    protected $paginationTheme = 'bootstrap';


    public $name_ar;
    public $name_en;
    public $email;
    public $mobile;
    public $password;
    public $password_confirmation;
    public $image;
    public $imageDB;

    public function mount()
    {
        $this->name_ar = auth('admin')->user()->getTranslation('name', 'ar');
        $this->name_en = auth('admin')->user()->getTranslation('name', 'en');
        $this->email = auth('admin')->user()->email;
        $this->mobile = auth('admin')->user()->mobile;
        $this->imageDB = auth('admin')->user()->firstMedia;

    }

    public function rules()
    {
        return [
            'name_ar' => ['required'],
            'name_en' => ['required'],
            'email' => ['required','email','unique:admins,email,'.auth('admin')->user()->id],
            'mobile' => ['required','unique:admins,mobile,'.auth('admin')->user()->id],
            'password' => ['nullable', Password::min(8)],
            'password_confirmation' => ['same:password'],
            'image' => ['nullable']
        ];
    }

    protected function data()
    {

        $input['name'] = ['ar' => $this->name_ar, 'en' => $this->name_en];
        $input['email'] = $this->email;
        $input['mobile'] = $this->mobile;
        if (trim($this->password) != ''){
            $input['password'] = bcrypt($this->password);
        }

        auth('admin')->user()->update($input);
        if($imageU = $this->image){

            if (auth('admin')->user()->firstMedia()->count() > 0) {

                if (File::exists('assets/images/admin/users/' . auth('admin')->user()->firstMedia->file_name)) {
                    unlink('assets/images/admin/users/' . auth('admin')->user()->firstMedia->file_name);

                    auth('admin')->user()->firstMedia->delete();
                }
            }

            $file_name = auth('admin')->user()->mobile.'_'.time().'_'.'.'.$imageU->getClientOriginalExtension();
            $file_size= $imageU->getSize();
            $file_type = $imageU->getMimeType();
            $path = public_path('/assets/images/admin/users/'.$file_name);
            Image::make($imageU->getRealPath())->resize(500,null,function ($constraint){
                $constraint->aspectRatio();
            })->save($path,100);

            auth('admin')->user()->firstMedia()->create([
                'file_name' => $file_name,
                'file_size' => $file_size,
                'file_type'=>$file_type,
                'file_status'=>true,
                'file_sort'=>1,
            ]);



        }
    }

    public function update()
    {
        $this->validate();
        $this->data();
        $this->alert('success','تم تعديل الملف الشخصي بنجاح !');

    }

    public function render()
    {
        return view('livewire.admin.profile.profile-component');
    }
}
