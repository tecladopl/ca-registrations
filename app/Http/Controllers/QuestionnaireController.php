<?php

namespace App\Http\Controllers;

use App\Models\ApplicantAnswer;
use App\Models\Question;
use App\Models\Questionnaire;
use App\Models\QuestionnairePage;
use App\Models\QuestionnaireParticipant;
use App\Models\Result;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Applicant;
use App\Models\Assembly;
use App\Models\Logs;
use Illuminate\Support\Facades\Log;
use Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class QuestionnaireController extends Controller
{

    public $questionnaire;
    public QuestionnairePage $questionnairePage;

    public function __construct(Request $request)
    {
        app()->setLocale('ge');
        //app()->setLocale(session('locale'));

    }

    public function setLocale(Request $request)
    {
        $locale = $request->input('locale');
        app()->setLocale($locale);
        return redirect('/');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->questionnaire = Questionnaire::getByPath($request);
        Logs::logEvent('Main page visited');
        if (empty($this->questionnaire)) {
            $view = 'index';
            $data = [];
        } else {
            $view = 'questionnaire.first2';
            $data = ['questionnaire' => $this->questionnaire, 'path' => $this->questionnaire->path];
        }
        return view($view)->with($data);
    }

    public function indexApplicant(Request $request)
    {
        $this->questionnaire = Questionnaire::getByPath($request);
        Logs::logEvent('Main page visited');
        if (empty($this->questionnaire)) {
            $view = 'index';
            $data = ['questionnaires' => Questionnaire::all()];
        } else {
            $view = 'questionnaire.first';
            $data = ['questionnaire' => $this->questionnaire, 'path' => $this->questionnaire->path, 'assembly' => Assembly::where('id', $this->questionnaire->assembly_id)->first()];
        }
        return view($view)->with($data);
    }

    public function signIn(Request $request)
    {

        
        $this->questionnaire = Questionnaire::getByPath($request);
        
        Logs::logEvent('Registration attempt');

        $applicant = Applicant::setupApplicant($request);
        if ($applicant === NULL) {
            return redirect($this->questionnaire->path)->withErrors(['access-error' => trans('Incorrect code')]);
        } elseif ($applicant === 'registered') {
            return redirect($this->questionnaire->path)->withErrors(['access-error' => trans('Questionnaire already completed')]);
        } else {
            return redirect($this->questionnaire->path . '/' . $applicant->current_page);
        }

    }

    public function signIn2(Request $request)
    {
        $this->questionnaire = Questionnaire::getByPath2($request);
        $request->validate([
            'name' => 'required|string',
            'access_code' => 'required|string',
        ]);
        $applicant = Applicant::setupApplicant2($request);

        if ($applicant === NULL) {
            return redirect($this->questionnaire->path)->withErrors(['access-error' => trans('Väärad andmed')]);
        } elseif ($applicant === 'registered'){
            return redirect($this->questionnaire->path)->withErrors(['access-error' => trans('Registreeritud')]);
        } else {
            return redirect($this->questionnaire->path . '/1');
        }

    }

    public function nickname(Request $request)
    {
        $this->questionnaire = Questionnaire::getByPath2($request);
        $applicant = Applicant::getApplicant2($request);
        if ($applicant === NULL) {
            return redirect($this->questionnaire->path)->withErrors(['session' => 'Twoja sesja wygasła - zaloguj sie ponownie.']);
        }
        if ($applicant->nickname !== NULL) {
            return redirect($this->questionnaire->path . '/' . $applicant->current_page);
        }
        $view = 'questionnaire.second';
        return view($view, [
            'applicant' => $applicant,
            'questionnaire' => $this->questionnaire, 'path' => $this->questionnaire->path
        ]);
    }

    public function nicknameSave(Request $request)
    {

        $rule = new \App\Rules\Nickname($request);
        $rules = [
            'nickname' => ['required', 'string', 'alpha', $rule],
        ];
        $request->validate($rules);
        $applicant = Applicant::getApplicant2($request);

        $this->questionnaire = Questionnaire::getByPath2($request);
        if ($applicant === NULL) {
            return redirect($this->questionnaire->path)->withErrors(['access-error' => 'Nieprawidłowe dane']);
        } else {
            $applicant->nickname = $request->input('nickname');
            $applicant->save();
            return redirect($this->questionnaire->path . '/' . $applicant->current_page);
        }
    }


    public function result()
    {

        $data2 = DB::select('select distinct losowanie, name from wyniki');

        foreach ($data2 as $id => $losowanie) {
            $data[$losowanie->losowanie]['losowanie'] = $losowanie->losowanie;
            $data[$losowanie->losowanie]['name'] = $losowanie->name;
            $data[$losowanie->losowanie]['stats']['plec'] = DB::select('select
losowanie, plec, count(*) as liczba
from wyniki
where losowanie = :losowanie
group by losowanie, plec', ['losowanie' => $losowanie->losowanie]);

            $data[$losowanie->losowanie]['stats']['wiek'] = DB::select('select
losowanie, wiek, count(*) as liczba
from wyniki
where losowanie = :losowanie
group by losowanie, wiek', ['losowanie' => $losowanie->losowanie]);

            $data[$losowanie->losowanie]['stats']['wyksztalcenie'] = DB::select('select
losowanie, wyksztalcenie, count(*) as liczba
from wyniki
where losowanie = :losowanie
group by losowanie, wyksztalcenie', ['losowanie' => $losowanie->losowanie]);


            $data[$losowanie->losowanie]['stats']['klimat'] = DB::select('select
losowanie, klimat, count(*) as liczba
from wyniki
where losowanie = :losowanie
group by losowanie, klimat', ['losowanie' => $losowanie->losowanie]);

            $data[$losowanie->losowanie]['stats']['osiedle'] = DB::select('select
losowanie, osiedle, count(*) as liczba
from wyniki
where losowanie = :losowanie
group by losowanie, osiedle', ['losowanie' => $losowanie->losowanie]);
            $data[$losowanie->losowanie]['osoby'] = DB::select('select
                distinct kod
from wyniki
where losowanie = :losowanie
', ['losowanie' => $losowanie->losowanie]);
        }

        return view('questionnaire.result')->with(['data' => $data]);
    }

    public function result2(Request $request)
    {

        $this->questionnaire = Questionnaire::getByPath2($request);
        $questionnairePages = QuestionnairePage::where('questionnaire_id', $this->questionnaire->id)->get();
        $questionnairePagesIds = $questionnairePages->pluck('id')->toArray();
        $questions = Question::whereIn('questionnaire_page_id', $questionnairePagesIds)->with('answers')->orderBy('order')->get();
        $questionsIds = $questions->pluck('id')->toArray();
        $questions = $questions->chunk(4);
        $appliantAnswers = ApplicantAnswer::whereIn('question_id', $questionsIds)->with('question')
            ->with('applicant')
            ->with('answers')
            ->whereHas('applicant', function ($query) {
                return $query->where('questionnaire_completed', '=', 1);
            })->get();
        $data = [];
        foreach ($questions as $key => $question) {
            foreach ($question as $chunk) {
                foreach ($appliantAnswers as $appliantAnswer) {
                    if ($chunk->id == $appliantAnswer->question->id) {
                        $data[$key][$appliantAnswer->applicant->nickname][$chunk->question] = $appliantAnswer->answers->text;
                    }
                }
            }
        }

        $data2 = DB::select('select q.question as "prop",
sum(an.points) as "sum_pts",
count(distinct aa.id) as "glos",
count(distinct case when an.points>0 then aa.id end) as "glos_pop",
round((count(distinct case when an.points>0 then aa.id end)/count(distinct aa.id)),3) as "pop",
count(distinct case when an.order=0 then aa.id end) as "nd",
round(sum(an.points)/count(distinct aa.id),2) as "sred",
       qp.page as "page",
       q.order as "qorder"
from applicants a
join applicant_answers aa on a.id = aa.applicant_id
join questions q on q.id = aa.question_id
join answers an on an.id = aa.answer_id
join questionnaire_pages qp on qp.id = q.questionnaire_page_id
join questionnaires qu on qu.id = qp.questionnaire_id
where a.nickname is not null
and a.questionnaire_completed = 1 and qu.id = :questionnaire_id
and aa.deleted_at is null
group by aa.question_id
order by qp.page, q.order', ['questionnaire_id' => $this->questionnaire->id]);

        return view('questionnaire.result2')->with(['data' => $data, 'data2' => $data2, 'questions' => $questions]);
    }
   public function result3(Request $request)
    {

    $data = DB::select('select q.question as "prop",
sum(an.points) as "sum_pts",
count(distinct aa.id) as "glos",
count(distinct case when an.points>0 then aa.id end) as "glos_pop",
round((count(distinct case when an.points>0 then aa.id end)/count(distinct aa.id)),3) as "pop",
count(distinct case when an.order=0 then aa.id end) as "nd",
round(sum(an.points)/count(distinct aa.id),2) as "sred",
       qp.page as "page",
       q.order as "qorder"
from applicants a
join applicant_answers aa on a.id = aa.applicant_id
join questions q on q.id = aa.question_id
join answers an on an.id = aa.answer_id
join questionnaire_pages qp on qp.id = q.questionnaire_page_id
join questionnaires qu on qu.id = qp.questionnaire_id
where a.nickname is not null
and a.questionnaire_completed = 1 and qu.id = 1
and aa.deleted_at is null
group by aa.question_id
order by qp.page, q.order');

        $data2 = DB::select('select q.question as "prop",
sum(an.points) as "sum_pts",
count(distinct aa.id) as "glos",
count(distinct case when an.points>0 then aa.id end) as "glos_pop",
round((count(distinct case when an.points>0 then aa.id end)/count(distinct aa.id)),3) as "pop",
count(distinct case when an.order=0 then aa.id end) as "nd",
round(sum(an.points)/count(distinct aa.id),2) as "sred",
       qp.page as "page",
       q.order as "qorder"
from applicants a
join applicant_answers aa on a.id = aa.applicant_id
join questions q on q.id = aa.question_id
join answers an on an.id = aa.answer_id
join questionnaire_pages qp on qp.id = q.questionnaire_page_id
join questionnaires qu on qu.id = qp.questionnaire_id
where a.nickname is not null
and a.questionnaire_completed = 1 and qu.id = :questionnaire_id
and aa.deleted_at is null
group by aa.question_id
order by qp.page, q.order');

        return view('questionnaire.result3')->with(['data' => $data, 'data2' => $data2, 'questions' => $questions]);
    }

    public
    function resultSearch(Request $request)
    {

        $number = $request->input('code');
        if (empty($number)) {
            return $this->result();
        }

        $data2 = DB::select('select distinct losowanie, name from wyniki where kod = :number ', ['number' => $number]);

        if (empty($data2)) {
            return redirect('poznan/wyniki')->withErrors(['code' => 'Wprowadzony kod nie został odnaleziony.']);
        }


        $data = [];

        foreach ($data2 as $id => $losowanie) {
            $data[$losowanie->losowanie]['losowanie'] = $losowanie->losowanie;
            $data[$losowanie->losowanie]['name'] = $losowanie->name;
            $data[$losowanie->losowanie]['stats']['plec'] = DB::select('select
losowanie, plec, count(*) as liczba
from wyniki
where losowanie = :losowanie
group by losowanie, plec', ['losowanie' => $losowanie->losowanie]);

            $data[$losowanie->losowanie]['stats']['wiek'] = DB::select('select
losowanie, wiek, count(*) as liczba
from wyniki
where losowanie = :losowanie
group by losowanie, wiek', ['losowanie' => $losowanie->losowanie]);

            $data[$losowanie->losowanie]['stats']['wyksztalcenie'] = DB::select('select
losowanie, wyksztalcenie, count(*) as liczba
from wyniki
where losowanie = :losowanie
group by losowanie, wyksztalcenie', ['losowanie' => $losowanie->losowanie]);


            $data[$losowanie->losowanie]['stats']['klimat'] = DB::select('select
losowanie, klimat, count(*) as liczba
from wyniki
where losowanie = :losowanie
group by losowanie, klimat', ['losowanie' => $losowanie->losowanie]);

            $data[$losowanie->losowanie]['stats']['osiedle'] = DB::select('select
losowanie, osiedle, count(*) as liczba
from wyniki
where losowanie = :losowanie
group by losowanie, osiedle', ['losowanie' => $losowanie->losowanie]);
            $data[$losowanie->losowanie]['osoby'] = DB::select('select
                distinct kod
from wyniki
where losowanie = :losowanie and kod = :number
', ['losowanie' => $losowanie->losowanie, 'number' => $number]);
        }

        return view('questionnaire.result')->with(['data' => $data, 'code' => $number]);
    }

    public
    function notify()
    {
        $applicants = Applicant::where('questionnaire_completed', 1)->whereNotNull('email')->get();
        foreach ($applicants as $applicant) {
            Mail::send('questionnaire.notify', ['applicant' => $applicant], function ($message) use ($applicant) {
                $message->to($applicant->email, $applicant->name)->subject('Pierwszy etap losowania do panelu ukończony!');
                $message->bcc('dkozlowski@teclado.pl');
                $message->getHeaders()
                    ->addTextHeader('Return-Path', 'dkozlowski@teclado.pl');
            });
        }
    }

    public
    function notify2()
    {
        $applicants = QuestionnaireParticipant::whereNotNull('email')->get();
        foreach ($applicants as $applicant) {
            Mail::send('questionnaire.notify', ['applicant' => $applicant], function ($message) use ($applicant) {
                $message->to($applicant->email)->subject('Invitation');
            });
        }
    }

    public function indexAdmin()
    {
        if (Questionnaire::count() > 0) {
            $questionnaire_id = auth()->user()->getCurrentQuestionnaire();
            if (empty($questionnaire_id) || Questionnaire::where('id', $questionnaire_id)->get()->isEmpty()) {
                $questionnaire_id = Questionnaire::first()->id;
                auth()->user()->setCurrentQuestionnaire($questionnaire_id);
            }
            $questionnaire = Questionnaire::where('id', $questionnaire_id)->first();
        } else {
            $questionnaire = [];
        }

        return view('questionnaire.index', ['questionnaire' => $questionnaire]);
    }

    public function settings()
    {
        $questionnaire_id = auth()->user()->getCurrentQuestionnaire();
        
        if (empty($questionnaire_id) || Questionnaire::where('id', $questionnaire_id)->get()->isEmpty()){
            $questionnaire_id = Questionnaire::first()->id;
            auth()->user()->setCurrentQuestionnaire($questionnaire_id);
        }
        $questionnaire = Questionnaire::where('id',$questionnaire_id)->first();
        return view('questionnaire.settings', ['questionnaire' => $questionnaire]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public
    function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public
    function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Questionnaire $questionnaire
     * @return \Illuminate\Http\Response
     */
    public
    function show(Questionnaire $questionnaire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Questionnaire $questionnaire
     * @return \Illuminate\Http\Response
     */
    public
    function edit(Questionnaire $questionnaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Questionnaire $questionnaire
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, Questionnaire $questionnaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Questionnaire $questionnaire
     * @return \Illuminate\Http\Response
     */
    public
    function destroy(Questionnaire $questionnaire)
    {
        //
    }
}