<?php

namespace App\Http\Livewire\Admin\Customers;

use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CustomersComponent extends Component
{
    use WithPagination,WithFileUploads,LivewireAlert;
    protected $paginationTheme = 'bootstrap';

    public $first_name;
    public $last_name;
    public $email;
    public $mobile;
    public $username;
    public $password;
    public $status;
    public $user_image;
    public $imageDB;
    public $name;
    public $customer_id;


    public function resetData()
    {
        $this->first_name = null;
        $this->last_name = null;
        $this->username = null;
        $this->email = null;
        $this->mobile = null;
        $this->password = null;
        $this->status = null;
        $this->user_image = null;
        $this->imageDB = null;
        $this->name = null;
        $this->user_id = null;

    }

    public function rules()
    {



                return [
                    'first_name'    => 'required',
                    'last_name'     => 'required',
                    'username'      => 'required|max:20|unique:users,username,'.$this->customer_id,
                    'email'         => 'required|email|max:255|unique:users,email,'.$this->customer_id,
                    'mobile'        => 'required|numeric|unique:users,mobile,'.$this->customer_id,
                    'status'        => 'required',
                    'password'      => 'nullable|min:8',
                    'user_image'    => 'nullable|mimes:jpg,jpeg,png,svg|max:20000'
                ];

    }

    protected $messages = [
        'first_name.required' => 'هذا الحقل لا يجب أن يكون فارغ',
        'last_name.required' => 'هذا الحقل لا يجب أن يكون فارغ',
        'email.required' => 'هذا الحقل لا يجب أن يكون فارغ',
        'email.unique' => 'هذا الحقل موجود مسبقا',
        'username.required' => 'هذا الحقل لا يجب أن يكون فارغ',
        'username.unique' => 'هذا الحقل موجود مسبقا',
        'mobile.required' => 'هذا الحقل لا يجب أن يكون فارغ',
        'mobile.unique' => 'هذا الحقل موجود مسبقا',
        'password.required' => 'هذا الحقل لا يجب أن يكون فارغ',
        'password.min' => 'هذا الحقل لا يجب أن يكون أقل من 8 أحرف',
        'status.required' => 'هذا الحقل لا يجب أن يكون فارغ',

    ];


    public function modalData()
    {
        $input['first_name'] = $this->first_name;
        $input['last_name'] = $this->last_name;
        $input['username'] = $this->username;
        $input['email'] = $this->email;
        $input['mobile'] = $this->mobile;
        $input['password'] = bcrypt($this->password);
        $input['status'] = $this->status;


        if ($image = $this->user_image) {
            $file_name = Str::slug($this->username).".".$image->getClientOriginalExtension();
            $path = public_path('/assets/images/customer/' . $file_name);
            Image::make($image->getRealPath())->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);
            $input['user_image'] = $file_name;
        }
        $customer = User::create($input);
        $customer->markEmailAsVerified();

    }

    public function addCustomer()
    {
        $this->validate();
        $this->modalData();
        $this->resetData();
        $this->dispatchBrowserEvent('closeModalAdd');
        $this->alert('success','تم إضافة المستخدم بنجاح !');
    }


    public function editCustomer($id)
    {
        $customer = User::whereId($id)->first();

        $this->first_name = $customer->first_name;
        $this->last_name = $customer->last_name;
        $this->username = $customer->username;
        $this->email = $customer->email;
        $this->mobile = $customer->mobile;
        $this->status = $customer->status;
        $this->imageDB = $customer->user_image;
        $this->customer_id = $id;
    }

    public function updateModalData()
    {

        $customer = User::whereId($this->customer_id)->first();
        $input['first_name'] = $this->first_name;
        $input['last_name'] = $this->last_name;
        $input['username'] = $this->username;
        $input['email'] = $this->email;
        $input['mobile'] = $this->mobile;
        if (trim($this->password) != ''){
            $input['password'] = bcrypt($this->password);
        }
        $input['status'] = $this->status;

        if ($image = $this->user_image) {
            if ($customer->user_image != null && File::exists('assets/images/customer/'. $customer->user_image)){
                unlink('assets/images/customer/'. $customer->user_image);
            }
            $file_name = Str::slug($this->username).'_'.time().'_'.'.'.$image->getClientOriginalExtension();
            $path = public_path('assets/images/customer/' . $file_name);
            Image::make($image->getRealPath())->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($path, 100);
            $input['user_image'] = $file_name;
        }

     $customer->update($input);


    }
    public function updateCustomer()
    {

        $this->validate();
        $this->updateModalData();
        $this->resetData();
        $this->dispatchBrowserEvent('closeModalUpdate');
        $this->alert('success','تم تعديل المستخدم بنجاح !');
    }

    public function show_delete_customer($id)
    {
        $this->resetData();
        $customer = User::whereId($id)->first();
        $this->customer_id = $id;
        $this->name= $customer->full_namee;

    }

    public function delete_customer()
    {
        $customer = User::whereId($this->customer_id)->first();

        if ($customer->user_image != '') {

            if (File::exists('assets/images/customer/' . $customer->user_image)) {
                unlink('assets/images/customer/' . $customer->user_image);

            }
        }

        $customer->delete();
        $this->dispatchBrowserEvent('closeModalDelete');
        $this->alert('error','تم الحذف بنجاح !');


    }

    public function render()
    {
        return view('livewire.admin.customers.customers-component',[
            'customers' => User::orderBy('id','DESC')->paginate(10)
        ]);
    }
}
