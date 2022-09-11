<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Yousefpackage\Visits\Models\Visit;

class VisitsComponent extends Component
{

    public $currentDayVisits = 0;
    public $currentMonthVisits = 0;
    public $currentYarlyEarning = 0;



    public function mount()
    {
        $this->currentDayVisits = Visit::whereDay('created_at', date('d'))->count();
        $this->currentMonthVisits = Visit::whereMonth('created_at', date('m'))->count();
        $this->currentYarlyEarning = Visit::whereYear('created_at', date('Y'))->count();
    }
    public function render()
    {
        return view('livewire.admin.visits-component');
    }
}
