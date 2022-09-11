<?php

namespace App\Http\Livewire\Admin\SocialMedia;

use App\Models\Backend\SocialMedia;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class SocialMediaComponent extends Component
{
    use WithPagination,LivewireAlert;
    protected $paginationTheme = 'bootstrap';

    public $link;
    public $name;
    public $social_id;

    public function resetData()
    {
        $this->link = null;
        $this->name = null;
        $this->social_id = null;


    }

    public function rules()
    {
        return [
            'link' => ['required'],
            'name' => ['required'],
        ]   ;
    }

    public function modalData()
    {
        $input['link'] = $this->link;
        $input['name'] = $this->name;


        \App\Models\Backend\SocialMedia::create($input);
    }

    public function addSocial()
    {

        $this->validate();
        $this->modalData();
        $this->resetData();
        $this->dispatchBrowserEvent('closeModalAdd');
        $this->alert('success','تم إضافة الموقع بنجاح !');
    }

    public function editSocial($id)
    {
        $this->resetData();

        $social = \App\Models\Backend\SocialMedia::whereId($id)->first();
        $this->link = $social->link;
        $this->name = $social->name;
        $this->social_id = $social->id;
    }

    public function updateModalData()
    {
        $social = \App\Models\Backend\SocialMedia::whereId($this->social_id)->first();
        $input['link'] = $this->link;
        $input['name'] = $this->name;


        $social->update($input);

    }

    public function updateSocial()
    {
        $this->validate();
        $this->updateModalData();
        $this->resetData();
        $this->dispatchBrowserEvent('closeModalUpdate');
        $this->alert('success','تم تعديل الموقع بنجاح !');
    }


    public function show_delete_social($id)
    {
        $this->resetData();
        $social = \App\Models\Backend\SocialMedia::whereId($id)->first();
        $this->social_id = $id;
        $this->name = $social->name;

    }

    public function deleteSocial()
    {
        $social = \App\Models\Backend\SocialMedia::whereId($this->social_id)->first();


        $social->delete();
        $this->dispatchBrowserEvent('closeModalDeleteS');
        $this->alert('error','تم الحذف بنجاح !');

    }

    public function render()
    {

        $socials = SocialMedia::orderBy('id','DESC')->paginate(10);
        return view('livewire.admin.social-media.social-media-component',[

            'socials' => $socials
        ]);
    }
}
