<?php

namespace App\Rules;

use App\Models\Applicant;
use App\Models\Questionnaire;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Psr\Log\NullLogger;

class Nickname implements Rule
{

    public Questionnaire $questionnaire;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->questionnaire = Questionnaire::getByPath2($request);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $nickname = Applicant::whereNotNull('questionnaire_id')->where('questionnaire_id',$this->questionnaire->id)->where('nickname',$value)->whereNotNull('nickname')->first();
        if($nickname!=Null){
            return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Pseudonim został już użyty.';
    }
}
