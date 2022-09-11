<?php

namespace App\Http\Livewire\Admin\Cover;

use Livewire\Component;
use Livewire\WithFileUploads;

class CoverImage extends Component
{


    use WithFileUploads;

    public $cover;

    public $cover_image;



    public function render()
    {
        return view('livewire.admin.cover.cover-image',[

            'cover_imageDB' => $this->cover->cover_image
        ]);
    }
}
