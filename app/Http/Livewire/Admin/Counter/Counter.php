<?php

namespace App\Http\Livewire\Admin\Counter;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Counter extends Component
{
    use WithPagination,LivewireAlert;
    protected $paginationTheme = 'bootstrap';

    public $title;
    public $title_ar;
    public $title_en;
    public $counter;
    public $icon;
    public $counter_id;


    public function resetData()
    {
        $this->title_ar = null;
        $this->title_en = null;
        $this->counter = null;
        $this->icon = null;


    }

    public function rules()
    {
        return [
            'title_ar' => ['required'],
            'title_en' => ['required'],
            'counter' => ['required'],
            'icon' => ['required'],

        ]   ;
    }

    public function modalData()
    {
        $input['title'] = ['ar' => $this->title_ar, 'en' => $this->title_en];
        $input['counter'] = $this->counter;
        $input['icon'] = $this->icon;


        \App\Models\Counter::create($input);
    }

    public function addCounter()
    {

        $this->validate();
        $this->modalData();
        $this->resetData();
        $this->dispatchBrowserEvent('closeModalAdd');
        $this->alert('success','تم إلإضافة بنجاح !');
    }

    public function editCounter($id)
    {
        $this->resetData();

        $counter = \App\Models\Counter::whereId($id)->first();
        $this->title_ar = $counter->getTranslation('title','ar');
        $this->title_en = $counter->getTranslation('title','en');
        $this->counter = $counter->counter;
        $this->icon = $counter->icon;
        $this->counter_id = $counter->id;
    }


    public function updateModalData()
    {
        $counter = \App\Models\Counter::whereId($this->counter_id)->first();
        $input['title'] = ['ar' => $this->title_ar, 'en' => $this->title_en];
        $input['counter'] = $this->counter;
        $input['icon'] = $this->icon;


        $counter->update($input);

    }

    public function updateCounter()
    {
        $this->validate();
        $this->updateModalData();
        $this->resetData();
        $this->dispatchBrowserEvent('closeModalUpdate');
        $this->alert('success','تم التعديل بنجاح !');
    }

    public function show_delete_counter($id)
    {
        $this->resetData();
        $counter = \App\Models\Counter::whereId($id)->first();
        $this->counter_id = $id;
        $this->title = $counter->title;

    }

    public function deleteCounter()
    {
        $counter = \App\Models\Counter::whereId($this->counter_id)->first();


        $counter->delete();
        $this->dispatchBrowserEvent('closeModalDelete');
        $this->alert('error','تم الحذف بنجاح !');

    }
    public function render()
    {
        $counters = \App\Models\Counter::orderBy('id','DESC')->paginate(10);
        return view('livewire.admin.counter.counter',[
            'counters' => $counters
        ]);
    }
}
