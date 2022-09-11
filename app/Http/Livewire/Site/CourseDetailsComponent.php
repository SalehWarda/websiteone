<?php

namespace App\Http\Livewire\Site;

use App\Models\Backend\Course;
use Gloudemans\Shoppingcart\Facades\Cart;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CourseDetailsComponent extends Component
{

    use LivewireAlert;

    public $course;


    public function addToCart($id)
    {



        $course = Course::whereId($id)->whereStatus(true)->firstOrFail();
        $duplicates = Cart::instance('default')->search(function ($cartItem , $rowId ) use ($course) {
            return $cartItem->options->slug === $course->slug  ;
        });
        if ($duplicates->isNotEmpty()) {
            $this->alert('error', 'الدورة موجودة بالفعل !');
        } else {

            Cart::instance('default')->add($course->id, $course->title,1 ,$course->price,['type'=>'course','slug'=>$course->slug])->associate(Course::class);
            $this->emit('updateCart');

            $this->alert('success', 'تم إضافة الدورة في السلة بنجاح.');
        }


    }
    public function render()
    {
        return view('livewire.site.course-details-component');
    }
}
