<?php

namespace App\Http\Livewire\Admin\Services;

use App\Models\Backend\Service;
use App\Models\Backend\ServiceTiming;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Nicolaslopezj\Searchable\SearchableTrait;

class ServicesTimings extends Component
{
    use WithPagination,LivewireAlert;
    protected $paginationTheme = 'bootstrap';
    public $service_id;
    public $service_timings_from;
    public $service_timings_to;
    public $service_timings;
    public $time_id;
    public $name;


    public function resetData()
    {
        $this->service_id = null;
        $this->service_timings_from = null;
        $this->service_timings_to = null;
        $this->time_id = null;
        $this->name = null;

    }
    public function rules()
    {
        return [
            'service_id' => [Rule::requiredIf(!$this->time_id)],
            'service_timings_from' => [Rule::requiredIf(!$this->time_id)],
            'service_timings_to' => [Rule::requiredIf(!$this->time_id)],

        ];
    }

    protected $messages = [
        'service_id.required' => 'هذا الحقل لا يجب أن يكون فارغ',
        'service_timings_from.required' => 'هذا الحقل لا يجب أن يكون فارغ',
        'service_timings_to.required' => 'هذا الحقل لا يجب أن يكون فارغ',


    ];

    public function modalData()
    {

        $input['service_id'] =  $this->service_id;
        $input['service_timings_from'] =Carbon::parse( $this->service_timings_from)->format('Y-m-d H:i');
        $input['service_timings_to'] =Carbon::parse( $this->service_timings_to)->format('Y-m-d H:i');



        ServiceTiming::create($input);


    }

    public function addServiceTimings()
    {
        $this->validate();
        $this->modalData();
        $this->resetData();
        $this->dispatchBrowserEvent('closeModalAdd');
        $this->alert('success','تم إضافة الموعد بنجاح !');
    }


    public function editTime($id)
    {
        $this->resetData();
        $time = ServiceTiming::whereId($id)->first();
        $this->service_id = $time->service_id;
        $this->service_timings_from = Carbon::parse( $time->service_timings_from)->format('Y-m-d H:i');
        $this->service_timings_to = Carbon::parse( $time->service_timings_to)->format('Y-m-d H:i');

        $this->time_id = $id;

    }

    public function updateModalData()
    {

        $time = ServiceTiming::whereId($this->time_id)->first();

        $input['service_id'] =  $this->service_id;
        $input['service_timings_from'] =Carbon::parse( $this->service_timings_from)->format('Y-m-d H:i');
        $input['service_timings_to'] =Carbon::parse( $this->service_timings_to)->format('Y-m-d H:i');


        $time->update($input);



    }
    public function updateTime()
    {

        $this->validate();
        $this->updateModalData();
        $this->resetData();
        $this->dispatchBrowserEvent('closeModalUpdate');
        $this->alert('success','تم تعديل الموعد بنجاح !');
    }


    public function show_delete_time($id)
    {
        $this->resetData();
        $time = ServiceTiming::whereId($id)->first();
        $this->time_id = $id;
        $this->name = $time->service->name;
        $this->service_timings = Carbon::parse( $time->service_timings_from)->format('Y-m-d H:i');


    }

    public function deleteTime()
    {
        $time = ServiceTiming::whereId($this->time_id)->first();



        $time->delete();
        $this->dispatchBrowserEvent('closeModalDelete');
        $this->alert('error','تم الحذف بنجاح !');


    }
    public function render()
    {
        $timings = ServiceTiming::with('service')->orderByDesc('id')->paginate(10);
        $services = Service::orderByDesc('id')->get();

        return view('livewire.admin.services.services-timings',[
            'timings' => $timings,
            'services' => $services
        ]);
    }
}
