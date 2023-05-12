<?php

namespace App\Http\Livewire\Questionnaire;

use Livewire\Component;
use Illuminate\Http\Request;

class Last extends Component
{
    public $page;
    public $pages;
    public $questions;
    public $applicant;
    public $answers;
    public $answers2;
    public $questionnaire;
    public $assembly;
    public $declaration_of_data_compliance_with_the_truth;
    public $consent_to_the_processing_of_personal_data;
    public $phone;
    public $email;

    protected $rules = [
        'declaration_of_data_compliance_with_the_truth' => 'accepted',
        'consent_to_the_processing_of_personal_data' => 'accepted',
        'phone' => 'required|digits_between:8,15',
        'email' => 'nullable|email',
    ];



    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.questionnaire.last');
    }

    public function submit(Request $request)
    {
        $validatedData = $this->validate();
        $this->applicant->email = $validatedData['email'];
        $this->applicant->phone_no = $validatedData['phone'];
        $this->applicant->declaration_of_data_compliance_with_the_truth = $validatedData['declaration_of_data_compliance_with_the_truth'];
        $this->applicant->consent_to_the_processing_of_personal_data = $validatedData['consent_to_the_processing_of_personal_data'];
        $this->applicant->save();
        $this->redirect('/' . $this->questionnaire->path . '/last');
    }
}
