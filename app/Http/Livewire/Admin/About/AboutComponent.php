<?php

namespace App\Http\Livewire\Admin\About;

use App\Models\Backend\AboutUs;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class AboutComponent extends Component
{
 use WithFileUploads;

    public $about;
    public $image;



    public function render()
    {
        return view('livewire.admin.about.about-component',[
            'imageDB' => $this->about->image,

        ]);

    }
}
