<?php

namespace App\Http\Livewire\Admin\Services;

use App\Models\Backend\Service;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Nicolaslopezj\Searchable\SearchableTrait;

class ServicesComponent extends Component
{
    use WithPagination,LivewireAlert,WithFileUploads,SearchableTrait;
    protected $paginationTheme = 'bootstrap';

    public $service_ar;
    public $service_en;
    public $description_ar;
    public $description_en;
    public $price;
    public $status;
    public $images =[];
    public $imagesDB;
    public $service_id;
    public $service_name;
    public $statusS;
    public $keyword;
    public $order_by;
    public $limit_by;

    public function resetData()
    {
        $this->service_ar = null;
        $this->service_en = null;
        $this->description_ar = null;
        $this->description_en = null;
        $this->price = null;
        $this->status = null;
        $this->statusS = null;
        $this->service_name = null;
        $this->service_id = null;
        $this->images = null;
        $this->imagesDB = null;
    }

    public function rules()
    {
        return [
            'service_ar' => [Rule::requiredIf(!$this->service_id),'max:255','unique:services,name->ar,'. $this->service_id],
            'service_en' => [Rule::requiredIf(!$this->service_id),'max:255','unique:services,name->en,'. $this->service_id],
            'description_ar' => ['nullable'],
            'description_en' => ['nullable'],
            'price' => ['required'],
            'status' => ['required'],
            'images' => [Rule::requiredIf(!$this->service_id),'max:4']
        ];
    }

    protected $messages = [
        'service_ar.required' => 'هذا الحقل لا يجب أن يكون فارغ',
        'service_ar.max' => 'هذا الحقل لا يجب أن يزيد طوله عن 255 حرف',
        'service_ar.unique' => 'هذا الحقل موجود مسبقا',

        'service_en.required' => 'هذا الحقل لا يجب أن يكون فارغ',
        'service_en.max' => 'هذا الحقل لا يجب أن يزيد طوله عن 255 حرف',
        'service_en.unique' => 'هذا الحقل موجود مسبقا',

        'price.required' => 'هذا الحقل لا يجب أن يكون فارغ',
        'status.required' => 'هذا الحقل لا يجب أن يكون فارغ',
        'images.required' => 'هذا الحقل لا يجب أن يكون فارغ',
        'images.max' => 'لا يمكنك تحميل أكثر من 4 صور للخدمة الواحدة',

    ];


    public function modalData()
    {

        $this->emit('createDescription');
           $input['name'] = ['ar' => $this->service_ar, 'en' => $this->service_en];
           $input['name_ar'] = $this->service_ar;
           $input['description'] = ['ar' => $this->description_ar, 'en' => $this->description_en];
           $input['price'] = $this->price;
           $input['status'] = $this->status;


           $service = Service::create($input);

        if($this->images && count($this->images) > 0){
            $i=1;
            foreach ($this->images as $image){

                $file_name = $service->slug.'_'.time().'_'.$i.'.'.$image->getClientOriginalExtension();
                $file_size= $image->getSize();
                $file_type = $image->getMimeType();
                $path = public_path('/assets/images/admin/services/'.$file_name);
                Image::make($image->getRealPath())->resize(500,null,function ($constraint){
                    $constraint->aspectRatio();
                })->save($path,100);

                $service->media()->create([
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
    public function addService()
    {
        $this->validate();
        $this->modalData();
        $this->resetData();
        $this->dispatchBrowserEvent('closeModalAdd');
        $this->alert('success','تم إضافة الخدمة بنجاح !');
    }

    public function editService($id)
    {

        $this->resetData();
        $this->emit('showDescription');
        $service = Service::whereId($id)->first();
        $this->service_ar = $service->getTranslation('name','ar');
        $this->service_en = $service->getTranslation('name','en');
        $this->price = $service->price;
        $this->status = $service->status;

        $this->description_ar = $service->getTranslation('description','ar');
        $this->description_en = $service->getTranslation('description','en');
        $this->service_name = $service->name;
        $this->service_id = $id;
        $this->imagesDB = $service->media;

    }
    public function updateModalData()
    {

        $service = Service::whereId($this->service_id)->first();
        $input['name'] = ['ar' => $this->service_ar, 'en' => $this->service_en];
        $input['name_ar'] = $this->service_ar;
        $input['description'] = ['ar' => $this->description_ar, 'en' => $this->description_en];
        $input['price'] = $this->price;
        $input['status'] = $this->status;


        $service->update($input);

            if ($this->images && count($this->images) > 0) {
//                if ($service->media()->count() > 0) {
//                    foreach ($service->media as $media) {
//                        if (File::exists('assets/images/admin/services/' . $media->file_name)) {
//                            unlink('assets/images/admin/services/' . $media->file_name);
//                        }
//                        $media->delete();
//                    }
//                }
                $i = $service->media()->count() + 1;
                foreach ($this->images as $image) {
                    $file_name = $service->slug. '_' . time() . '_' . $i . '.' . $image->getClientOriginalExtension();
                    $file_size = $image->getSize();
                    $file_type = $image->getMimeType();
                    $path = public_path('/assets/images/admin/services/' . $file_name);

                    Image::make($image->getRealPath())->resize(500, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path, 100);

                    $service->media()->create([
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
    public function updateService()
    {

        $this->validate();
        $this->updateModalData();
        $this->resetData();
        $this->dispatchBrowserEvent('closeModalUpdate');
        $this->alert('success','تم تعديل الخدمة بنجاح !');
    }

    public function show_delete_service($id)
    {
        $this->resetData();
        $service = Service::where('id',$id)->first();
        $this->service_id = $id;
        $this->service_name = $service->name;

    }

    public function delete_service()
    {
        $service = Service::whereId($this->service_id)->first();

        if ($service->media()->count() > 0){

            foreach ($service->media as $media){

                if (File::exists('assets/images/admin/services/' . $media->file_name)) {

                    unlink('assets/images/admin/services/' . $media->file_name);

                }
                $media->delete();

            }
        }

        $service->delete();

        $this->dispatchBrowserEvent('closeModalDeleteService');
        $this->alert('error','تم الحذف بنجاح !');


    }


    public function render()
    {
        $services = Service::with('firstMedia')
            ->when($this->keyword != null ,function ($query){

                $query->search($this->keyword);
            })
            ->when($this->statusS != null ,function ($query){

                $query->whereStatus($this->statusS);
            })
            ->orderBy( 'id' , $this->order_by ?? 'desc')
            ->paginate($this->limit_by ?? 10);
        return view('livewire.admin.services.services-component',[
            'services' => $services
        ]);
    }
}
