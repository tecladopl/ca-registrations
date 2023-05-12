<?php

namespace App\Models;

use App\Http\Controllers\LocalizationController;
use App\Http\Middleware\SetLocale;
use App\Models\QuestionnaireParticipant;
use Carbon\Carbon;
use Dirape\Token\Token;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use App\Models\Logs;

class Applicant extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $guarded = [
        'session_token'
    ];



    public function questionnaire_participant()
    {
        return $this->hasOne(QuestionnaireParticipant::class);
    }

    public static function setupApplicant(Request $request)
    {


        
        //$name = strtolower($request->input('name'));
        $access = strtolower($request->input('code'));
        $questionnaire = Questionnaire::getByPath($request);
        $locale = session('locale');
        Logs::logEvent("New applicant request. Access code: " . $access);



        $applicant = self::checkSession($request);
        if ($applicant !== NULL) {

                $applicant->setSession($request, $applicant);

        } else {

            $questionnaireParticipant = QuestionnaireParticipant::whereNotNull('access_code')->where('access_code', $access)->whereNotNull('questionnaire_id')->where('questionnaire_id', $questionnaire->id)->first();

            if ($questionnaireParticipant !== NULL) {
                $applicants = Applicant::where('questionnaire_participant_id', $questionnaireParticipant->id)->where('questionnaire_completed', '=', 0)->get();
                // if ($applicants->isNotEmpty()){
                //     return 'registered';
                // }
                $applicant = new Applicant([
                    'questionnaire_participant_id' => $questionnaireParticipant->id,
                    'uuid' => Str::uuid(),
                    'identity_string' => (new Token())->UniqueNumber('applicants', 'identity_string', 6),
                    'current_page' => 1,
                    'questionnaire_id' => $questionnaire->id
                ]);
                $applicant->saveOrFail();
                Logs::logEvent("New applicant. ID: " . $applicant->primaryKey);
                $applicant->setSession($request, $applicant);
            } else {
                $applicant = NULL;
            }
        }

        app()->setLocale($locale);
        session(['locale' => $locale]);

        return $applicant;
    }


    public static function getApplicant(Request $request)
    {
        $applicant = self::checkSession($request);
        return $applicant;
    }

    public function deleteApplicant()
    {
        Log::stack(['app'])->debug(Carbon::now() . ' | Ankieta anulowana. | IP: [ ' . $_SERVER['REMOTE_ADDR'] . ' ] USER_AGENT: [ ' . $_SERVER['HTTP_USER_AGENT'] . ' ]');
        $this->delete();
        self::clearSession();
    }


    private function setSession(Request $request, Applicant $applicant)
    {
        $locale = session('locale');

        session()->flush();
        $session_token = (new Token())->Unique('applicants', 'session_token', 60);
        $applicant->session_token = $session_token;
        session()->put('questionnaire_participant_session_token', $session_token);
        session()->put('locale', $locale);
        session()->put('identity_string', Crypt::encryptString($applicant->identity_string));
        session()->save();
        $this->saveOrFail();

    }


    private static function checkSession(Request $request): ?Applicant
    {


        $applicant = NULL;
        $access_code = strtolower($request->input('code'));
        $session_token = session()->get('questionnaire_participant_session_token', NULL);
        $questionnaire = Questionnaire::getByPath($request);
        
        if ($session_token !== NULL && session()->get('identity_string', NULL)!==NULL) {
            $identity_string = Crypt::decryptString(urldecode(session()->get('identity_string', NULL)));
            $applicant = Applicant::where('identity_string', $identity_string)->where('session_token', $session_token)->whereNotNull('session_token')->whereNotNull('questionnaire_id')->where('questionnaire_id',$questionnaire->id)->where('questionnaire_completed', '=', 0)->first();
        }else{
            //$email = $request->input('email');
            //$name = strtolower($request->input('name'));
            $questionnaireParticipant = QuestionnaireParticipant::where('access_code', $access_code = strtolower($request->input('code')))->whereNotNull('questionnaire_id')->where('questionnaire_id', $questionnaire->id)->first();
            if($questionnaireParticipant!==NULL){
                //$applicant = Applicant::where('questionnaire_participant_id', $questionnaireParticipant->id)->whereNotNull('questionnaire_id')->where('questionnaire_id',$questionnaire->id)->where('questionnaire_completed', '=', 0)->first();
            }

        }

        if ($applicant === NULL) {
            Log::stack(['app', 'errors'])->debug(Carbon::now() . ' | Brak aplikanta w sesji. Token: ' . $session_token . '. Kod: ' . $access_code . ' | IP: [ ' . $_SERVER['REMOTE_ADDR'] . ' ] USER_AGENT: [ ' . $_SERVER['HTTP_USER_AGENT'] . ' ]');
            session()->flush();
            session()->save();
        }

        return $applicant;
    }

    public static function clearSession(): void
    {
        session()->flush();
        session()->regenerate(true);
        session()->save();
    }

    public static function phone($number)
    {
        $number = preg_replace("/[^0-9]/", "", $number);
        if (strlen($number) > 9 && strpos($number, '48') !== false && strpos($number, '48') === 0) {
            $number = substr($number, 2);
        }
        return $number;
    }

}
