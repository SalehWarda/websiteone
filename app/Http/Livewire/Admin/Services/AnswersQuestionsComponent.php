<?php

namespace App\Http\Livewire\Admin\Services;

use App\Models\Backend\Service;
use App\Models\UserServiceDate;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class AnswersQuestionsComponent extends Component
{
    use LivewireAlert,WithFileUploads;


    public $service;
    public $answer;
    public $service_date;







    public function resetData()
    {
        $this->answer = null;
        $this->service_date = null;


    }
    public function rules()
    {
        return [
            'answer' => ['required'],
            'service_date' => ['required'],


        ]   ;
    }

    protected $messages = [
        'answer.required' => 'هذا الحقل لا يجب أن يكون فارغ',
        'service_date.required' => 'هذا الحقل لا يجب أن يكون فارغ',


    ];

    public function modalData()
    {

        foreach ((array)$this->answer as $key=>$value){

            $input['answer'] = $value;
            $input['services_questions_id'] = $key;


            \App\Models\Backend\Answer::create($input);

        }

       $date = UserServiceDate::create([
            'user_id'=> auth()->user()->id,
            'service_id' => $this->service->id,
            'service_timings_id'=> $this->service_date
        ]);



    }
    public function addToCart($id)
    {



        if (auth('web')->check()){

            $service = Service::with('questions','serviceTimings')->whereId($id)->whereStatus('open')->firstOrFail();
            $duplicates = Cart::instance('default')->search(function ($cartItem, $rowId) use ($service) {
                return $cartItem->options->slug === $service->slug;
            });
            if ($duplicates->isNotEmpty()) {
                $this->alert('error', 'الخدمة موجودة بالفعل !');
            } else {


                if ($service->questions->count() > 0 && $service->serviceTimings->count() > 0){
                    $this->validate();
                }

                $this->modalData();
                $this->resetData();
                Cart::instance('default')->add($service->id, $service->name,1 ,$service->price,['type'=>'service','slug'=>$service->slug])->associate(Service::class);
                $this->emit('updateCart');

                $this->alert('success', 'تم إرسال الإجابات و إضافة الخدمة في السلة بنجاح.');
            }
        }else{

            return $this->redirectRoute('site.login.user');
        }



    }
    public function render()
    {


        return view('livewire.admin.services.answers-questions-component',[
            'questions' => $this->service->questions()->orderBy('id','DESC')->get(),
            'timings' => $this->service->serviceTimings()->orderBy('id','DESC')->get()

        ]);
    }
}
