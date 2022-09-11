<?php

namespace App\Http\Livewire\Admin\Services;

use App\Models\Backend\Service;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Nicolaslopezj\Searchable\SearchableTrait;

class ServicesQuestion extends Component
{
    use WithPagination,LivewireAlert,SearchableTrait;
    protected $paginationTheme = 'bootstrap';

    public $question_ar;
    public $question_en;
    public $service_id;
    public $sort;
    public $question_id;
    public $question_name;

//    public $keyword;
//    public $order_by;
//    public $limit_by;

    public function resetData()
    {
        $this->question_ar = null;
        $this->question_en = null;
        $this->sort = null;
        $this->service_id = null;
        $this->question_id = null;

    }

    public function rules()
    {
        return [
            'question_ar' => ['required','string'],
            'question_en' => ['required','string'],
            'sort' => ['required'],
            'service_id' => ['required','exists:services,id'],

        ]   ;
    }

    public function modalData()
    {
        $input['question'] = ['ar' => $this->question_ar, 'en' => $this->question_en];
        $input['sort'] = $this->sort;
        $input['service_id'] = $this->service_id;


         \App\Models\Backend\ServicesQuestion::create($input);
    }
    public function addQuestion()
    {

        $this->validate();
        $this->modalData();
        $this->resetData();
        $this->dispatchBrowserEvent('closeModalAddQuestion');
        $this->alert('success','تم إضافة السؤال بنجاح !');
    }

    public function editQuestion($id)
    {
        $this->resetData();
        $question = \App\Models\Backend\ServicesQuestion::whereId($id)->first();
        $this->question_ar = $question->getTranslation('question','ar');
        $this->question_en = $question->getTranslation('question','en');
        $this->sort = $question->sort;
        $this->question_name = $question->question;
        $this->service_id = $question->service_id;
        $this->question_id = $id;
    }
    public function updateModalData()
    {
        $question = \App\Models\Backend\ServicesQuestion::whereId($this->question_id)->first();
        $input['question'] = ['ar' => $this->question_ar, 'en' => $this->question_en];
        $input['sort'] = $this->sort;
        $input['service_id'] = $this->service_id;


        $question->update($input);

    }

    public function updateQuestion()
    {
        $this->validate();
        $this->updateModalData();
        $this->resetData();
        $this->dispatchBrowserEvent('closeModalUpdateQuestion');
        $this->alert('success','تم تعديل السؤال بنجاح !');
    }


    public function show_delete_question($id)
    {
        $this->resetData();
        $question = \App\Models\Backend\ServicesQuestion::whereId($id)->first();
        $this->question_id = $id;
        $this->question_name = $question->question;

    }

    public function delete_question()
    {
        $question = \App\Models\Backend\ServicesQuestion::whereId($this->question_id)->first();


        $question->delete();
        $this->dispatchBrowserEvent('closeModalDeleteQuestion');
        $this->alert('error','تم الحذف بنجاح !');

    }

    public function render()
    {
        $services = Service::get();
        $questions = \App\Models\Backend\ServicesQuestion::with('service')->paginate(10);
        return view('livewire.admin.services.services-question',[
            'questions' => $questions,
            'services' => $services
        ]);
    }
}
