<?php

namespace App\Http\Livewire\Admin\AdminUsers;

use App\Models\Backend\Admin;
use App\Models\Backend\Role;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Intervention\Image\Facades\Image;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Nicolaslopezj\Searchable\SearchableTrait;

class AdminUsersComponent extends Component
{

    use WithPagination,LivewireAlert,WithFileUploads,SearchableTrait;
    protected $paginationTheme = 'bootstrap';


    public $name_ar;
    public $name_en;
    public $email;
    public $mobile;
    public $password;
    public $password_confirmation;
    public $status;
    public $role;
    public $image;
    public $imageDB;
    public $name;
    public $user_id;




    public function resetData()
    {
        $this->name_ar = null;
        $this->name_en = null;
        $this->email = null;
        $this->mobile = null;
        $this->password = null;
        $this->password_confirmation = null;
        $this->status = null;
        $this->role = null;
        $this->image = null;
        $this->imageDB = null;
        $this->user_id = null;

    }

    public function rules()
    {
        return [
            'name_ar' => ['required'],
            'name_en' => ['required'],
            'email' => ['required','email','unique:admins,email,'.$this->user_id],
            'mobile' => ['required','unique:admins,mobile,'.$this->user_id],
            'password' => [Rule::requiredIf(!$this->user_id)],
            'password_confirmation' => ['same:password,'.$this->user_id],
            'status' => ['required'],
            'role' => ['required'],
            'image' => ['nullable']
        ];
    }
    protected $messages = [
        'name_ar.required' => 'هذا الحقل لا يجب أن يكون فارغ',
        'name_en.required' => 'هذا الحقل لا يجب أن يكون فارغ',
        'email.required' => 'هذا الحقل لا يجب أن يكون فارغ',
        'email.unique' => 'هذا الحقل موجود مسبقا',
        'mobile.required' => 'هذا الحقل لا يجب أن يكون فارغ',
        'mobile.unique' => 'هذا الحقل موجود مسبقا',
        'password.required' => 'هذا الحقل لا يجب أن يكون فارغ',
        'password.min' => 'هذا الحقل لا يجب أن يكون أقل من 8 أحرف',
        'password_confirmation.required' => 'هذا الحقل لا يجب أن يكون فارغ',
        'password_confirmation.same' => 'هذا الحقل ليس مشابه لكلمة المرور',
        'status.required' => 'هذا الحقل لا يجب أن يكون فارغ',
        'role.required' => 'هذا الحقل لا يجب أن يكون فارغ',

    ];

    public function modalData()
    {
        $input['name'] = ['ar' => $this->name_ar, 'en' => $this->name_en];
        $input['email'] = $this->email;
        $input['mobile'] = $this->mobile;
        $input['password'] = bcrypt($this->password) ;
        $input['status'] = $this->status;
        $input['roles'] = $this->role;


        $user = Admin::create($input);
        if($imageU = $this->image){



            $file_name = $user->mobile.'_'.time().'_'.'.'.$imageU->getClientOriginalExtension();
            $file_size= $imageU->getSize();
            $file_type = $imageU->getMimeType();
            $path = public_path('/assets/images/admin/users/'.$file_name);
            Image::make($imageU->getRealPath())->resize(500,null,function ($constraint){
                $constraint->aspectRatio();
            })->save($path,100);

            $user->firstMedia()->create([
                'file_name' => $file_name,
                'file_size' => $file_size,
                'file_type'=>$file_type,
                'file_status'=>true,
                'file_sort'=>1,
            ]);



        }


    }
    public function addUser()
    {
        $this->validate();
        $this->modalData();
        $this->resetData();
        $this->dispatchBrowserEvent('closeModalAdd');
        $this->alert('success','تم إضافة المستخدم بنجاح !');
    }

    public function editUser($id)
    {
        $admin = Admin::with('firstMedia')->whereId($id)->first();

        $this->name_ar = $admin->getTranslation('name','ar');
        $this->name_en = $admin->getTranslation('name','en');
        $this->email = $admin->email;
        $this->mobile = $admin->mobile;
        $this->status = $admin->status;
        $this->role = $admin->role->id;
        $this->imageDB = $admin->firstMedia;
        $this->user_id = $id;
    }

    public function updateModalData()
    {

        $admin = Admin::whereId($this->user_id)->first();
        $input['name'] = ['ar' => $this->name_ar, 'en' => $this->name_en];
        $input['email'] = $this->email;
        $input['mobile'] = $this->mobile;
        $input['password'] = bcrypt($this->password);
        $input['status'] = $this->status;
        $input['role'] = $this->role;


        $admin->update($input);

        if( $this->image){

            if ($admin->firstMedia()->count() > 0) {

                if (File::exists('assets/images/admin/users/' . $admin->firstMedia->file_name)) {
                    unlink('assets/images/admin/users/' . $admin->firstMedia->file_name);

                    $admin->firstMedia->delete();
                }
            }
                $file_name = $admin->id.'_'.time().'_'.'.'.$this->image->getClientOriginalExtension();
                $file_size= $this->image->getSize();
                $file_type = $this->image->getMimeType();
                $path = public_path('/assets/images/admin/users/'.$file_name);
                Image::make($this->image->getRealPath())->resize(500,null,function ($constraint){
                    $constraint->aspectRatio();
                })->save($path,100);

                $admin->firstMedia()->create([
                    'file_name' => $file_name,
                    'file_size' => $file_size,
                    'file_type'=>$file_type,
                    'file_status'=>true,
                    'file_sort'=>1,
                ]);



            }

    }
    public function updateUser()
    {

        $this->validate();
        $this->updateModalData();
        $this->resetData();
        $this->dispatchBrowserEvent('closeModalUpdate');
        $this->alert('success','تم تعديل المستخدم بنجاح !');
    }


    public function show_delete_user($id)
    {
        $this->resetData();
        $admin = Admin::where('id',$id)->first();
        $this->user_id = $id;
        $this->name= $admin->name;

    }

    public function delete_user()
    {
        $admin = Admin::whereId($this->user_id)->first();

        if ($admin->firstMedia() != '') {

            if (File::exists('assets/images/admin/users/' . $admin->firstMedia->file_name)) {
                unlink('assets/images/admin/users/' . $admin->firstMedia->file_name);

                $admin->firstMedia->delete();
            }
        }

        $admin->delete();
        $this->dispatchBrowserEvent('closeModalDelete');
        $this->alert('error','تم الحذف بنجاح !');


    }


    public function render()
    {
        $roles = Role::get();
        $users = Admin::with('firstMedia')->latest()->where('id', '<>', auth()->id())->orderBy('id','DESC')->paginate(10);
        return view('livewire.admin.admin-users.admin-users-component',[
            'roles' => $roles,
            'users' => $users
        ]);
    }
}
