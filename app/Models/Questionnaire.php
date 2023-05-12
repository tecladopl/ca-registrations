<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Models\Assembly;

class Questionnaire extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $fillable = ['name', 'path', 'description', 'start', 'end', 'assembly_id', 'first_page', 'is_past_msg', 'is_future_msg', 'last_page', 'confirmation_email', 'declaration_of_data_compliance_with_the_truth' , 'consent_to_the_processing_of_personal_data'];

    public static function getByPath(Request $request)
    {
        $path = $request->segment(1);
        if (is_null($path) || is_numeric($path) || $path === 'last' || $path === 'cancel') {
            $path = "";
        }
        $questionnaire = self::where('path', $path)->where('start', '<=', Carbon::now())->where('end', '>=', Carbon::now())->first();
        if (empty($questionnaire)) {
            $questionnaire = self::where('path', $path)->orderBy('end', 'desc')->first();
        }
        return $questionnaire;
    }

    public function checkSession(Request $request)
    {
        if ($request->session()->has('questionnaire_participant_session_token')) {
            $applicant = Applicant::getApplicant($request);
            if ($applicant === NULL) {
                return redirect()->withErrors(['session' => __('Your session has expired. Please, log in again')]);
            } else {
                return redirect($this->path . '/' . $applicant->current_page);
            }
        }
    }

    public function setPathAttribute($path) {
        $this->attributes['path'] = (string) $path;
    }

    public function assembly() {
        return $this->belongsTo(Assembly::class);
    }
}
