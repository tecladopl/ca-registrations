<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\ApplicantAnswer;
use App\Models\QuestionnairePage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Questionnaire;
use App\Models\Applicant;
use App\Models\Assembly;
use App\Models\Question;
use Illuminate\Support\Facades\Log;
use App\Models\Logs;
use Mail;
use Illuminate\Support\Facades\Validator;

class QuestionnairePageController extends Controller
{

    public $questionnaire;
    public $questionnairePage;

    public function __construct(Request $request)
    {
        $this->questionnaire = Questionnaire::getByPath($request);
        $this->questionnairePage = QuestionnairePage::getByPath($request);
        app()->setLocale('ge');
        //app()->setLocale(session('locale'));
    }


    public function cancel(Request $request)
    {
        $this->questionnaire = Questionnaire::getByPath($request);
        $applicant = Applicant::getApplicant($request);
        $applicant->clearSession();
        return redirect($this->questionnaire->path);
    }


    public function page(Request $request, ?string $path, ?int $page)
    {

        $this->questionnaire = Questionnaire::getByPath($request);
        if (empty($this->questionnaire)) {
            abort(404);
        }
        Logs::logEvent('Page visited: ' . $page);

        $applicant = Applicant::getApplicant($request);
        if ($applicant === NULL) {
            return redirect($path)->withErrors(['session' => 'Twoja sesja wygasła - wpisz kod ponownie.']);
        }

        $pages = QuestionnairePage::where('questionnaire_id', $this->questionnaire->id)->get();
        $assembly = Assembly::where('id',$this->questionnaire->assembly_id)->first();
        if (count($pages) + 1 <= (int)$page) {
            $answers2 = ApplicantAnswer::with(['question', 'answers'])->where('applicant_id', $applicant->id)->get();
            foreach($answers2 as $answer2) {
                if(!empty($answer2->answer_id)){
                    $answer2->answers = Answer::find($answer2->answer_id)->text;
                }

                
            }
            //dd($answers2);
            $view = 'questionnaire.last';
            $data = [
                'applicant' => $applicant,
                'answers2' => $answers2,
                'page' => $this->questionnairePage,
                'pages' => $pages->count(),
                'path' => $this->questionnaire->path,
                'questionnaire' => $this->questionnaire,
                'assembly' =>  $assembly
            ];
        } else {
            $this->questionnairePage = QuestionnairePage::where('page', $page)->where('questionnaire_id', $this->questionnaire->id)->first();

            $questions = Question::where('questionnaire_page_id', $this->questionnairePage->id)->orderBy('order')->with(['answers', 'question_type', 'applicant_answers'])->get();
            
            $questions_ids = $questions->pluck('id')->toArray();
            $answers = ApplicantAnswer::whereIn('question_id', $questions_ids)->where('applicant_id', $applicant->id)->get();
            $view = 'questionnaire.page';
            $data = [
                'applicant' => $applicant,
                'page' => $this->questionnairePage,
                'questions' => $questions,
                'answers' => $answers,
                'pages' => $pages->count(),
                'path' => $this->questionnaire->path,
                'questionnaire' => $this->questionnaire,
                'assembly' =>  $assembly
            ];
        }
        
        
        
        
        return view($view, $data);

    }

    public function page2(Request $request, ?int $page)
    {

        $this->questionnaire = Questionnaire::getByPath2($request);
        $questionnairePage = QuestionnairePage::where('page', $page)->where('questionnaire_id', $this->questionnaire->id)->first();
        if (empty($questionnairePage)) {
            abort(404);
        }
        $this->questionnairePage = $questionnairePage;
        $applicant = Applicant::getApplicant2($request);
        if ($applicant === NULL) {
            return redirect($this->questionnaire->path)->withErrors(['session' => 'Twoja sesja wygasła - wpisz kod ponownie.']);
        } elseif ($applicant->questionnaire_completed === 1) {
            return redirect($this->questionnaire->path)->withErrors(['session' => 'Głos został już oddany.']);
        }
        $questions = Question::where('questionnaire_page_id', $this->questionnairePage->id)->orderBy('order')->with(['answers','question_type','applicant_answers'])->get();
        $questions_ids = $questions->pluck('id')->toArray();
        $answers = ApplicantAnswer::whereIn('question_id', $questions_ids)->where('applicant_id', $applicant->id)->get();
        $answers2 = ApplicantAnswer::where('applicant_id', $applicant->id)->get();
        foreach ($answers2 as $answer2) {
            $answer2->load('answers');
            $answer2->load('question')->load('questionnaire_page');
        }
        $pages = QuestionnairePage::where('questionnaire_id', $this->questionnaire->id)->get();

        $view = 'questionnaire.page2';
        return view($view, [
            'applicant' => $applicant,
            'page' => $questionnairePage,
            'questions' => $questions,
            'answers' => $answers,
            'answers2' => $answers2,
            'pages' => $pages->count(),
            'path' => $this->questionnaire->path
        ]);

    }

    public function savePage(Request $request, ?string $path, ?int $page)
    {
        
        $this->questionnaire->checkSession($request);
        $input = $request->except(['_token', 'send']);
        $applicant = Applicant::getApplicant($request);
        if ($applicant === NULL) {
            return redirect($path)->withErrors(['session' => __('Your session has expired. Please, log in again')]);
        }
        foreach ($input as $input_name => $answers) {
            $question = Question::where('input_name', $input_name)->with(['validations','answers'])->first();
            if ($question->validations->isNotEmpty()) {
                foreach ($question->validations as $validation) {
                    Validator::make(
                        $input,
                        [$input_name => $validation->rule],
                        [$input_name . '.' . $validation->rule_name => $validation->message])
                        ->validate();
                }
            }
            if ($question->answers->isNotEmpty()) {
                foreach ($question->answers as $answer) {
                    $answer->load('validations');
                    if ($answer->validations->isNotEmpty()) {
                        foreach ($answer->validations as $validation) {
                            Validator::make(
                                $input,
                                [$input_name . '.' . $answer->id => $validation->rule],
                                [$input_name . '.' . $answer->id . '.' . $validation->rule_name => $validation->message])
                                ->validate();
                        }
                    }
                }
                if (is_array($answers)) {
                    foreach ($answers as $answer_id) {
                        $answer = new ApplicantAnswer();
                        $answer->question_id = $question->id;
                        $answer->answer_id = $answer_id;
                        $answer->applicant_id = $applicant->id;
                        $answer->save();
                    }
                } else {
                    $answer = new ApplicantAnswer();
                    $answer->question_id = $question->id;
                    $answer->answer_id = $answers;
                    $answer->applicant_id = $applicant->id;
                    $answer->save();
                }
            } else {
                $answer = new ApplicantAnswer();
                $answer->question_id = $question->id;
                $answer->answer_text = $answers;
                $answer->applicant_id = $applicant->id;
                $answer->save();
            }

        }
        $applicant->current_page = $page;
        $applicant->save();
        return redirect('/' . $path . '/' . $applicant->current_page);
    }

    public function savePage2(Request $request, ?int $page)
    {

        $this->questionnaire = Questionnaire::getByPath2($request);
        $this->questionnaire->checkSession2($request);
        $input = $request->except(['_token', 'send']);
        $applicant = Applicant::getApplicant2($request);
        if ($applicant === NULL) {
            return redirect($this->questionnaire->path)->withErrors(['session' => 'Twoja sesja wygasła - wpisz kod ponownie.']);
        }
        $page_id = QuestionnairePage::where('questionnaire_id',$this->questionnaire->id)->where('page',$page)->first()->id;
        $page_questions = Question::where('questionnaire_page_id', $page_id)->get();
        foreach ($page_questions as $page_question){
            $page_question->load('validations');
            $page_question->load('answers');
            if ($page_question->validations->isNotEmpty()) {
                foreach ($page_question->validations as $validation) {
                    Validator::make(
                        $input,
                        [$page_question->input_name => $validation->rule],
                        [$page_question->input_name . '.' . $validation->rule_name => $validation->message])
                        ->validate();
                }
            }
        }
        $previousAnswers = ApplicantAnswer::where('applicant_id', $applicant->id)->whereIn('question_id',$page_questions->pluck('id')->toArray())->get();
        $previousAnswers = $previousAnswers->whereNotIn('question_id',Question::whereIn('input_name', array_keys($input))->get()->pluck('id')->toArray());
        foreach ($previousAnswers as $previousAnswer){
            $previousAnswer->delete();
        }

        foreach ($input as $input_name => $answers) {
            $question = Question::where('input_name', $input_name)->get()->load('validations')->load('answers')->first();
            if ($question->validations->isNotEmpty()) {
                foreach ($question->validations as $validation) {
                    Validator::make(
                        $input,
                        [$input_name => $validation->rule],
                        [$input_name . '.' . $validation->rule_name => $validation->message])
                        ->validate();
                }
            }
            if ($question->answers->isNotEmpty()) {
                foreach ($question->answers as $answer) {
                    $answer->load('validations');
                    if ($answer->validations->isNotEmpty()) {
                        foreach ($answer->validations as $validation) {
                            Validator::make(
                                $input,
                                [$input_name . '.' . $answer->id => $validation->rule],
                                [$input_name . '.' . $answer->id . '.' . $validation->rule_name => $validation->message])
                                ->validate();
                        }
                    }
                }
                if (is_array($answers)) {
                    $answers2 = ApplicantAnswer::where('question_id', $question->id)->where('applicant_id', $applicant->id)->get();
                    if ($answers2->isNotEmpty()) {
                        foreach ($answers as $answer_id) {
                            if(!$answers2->contains('answer_id',$answer_id)){
                                $answer = new ApplicantAnswer();
                                $answer->question_id = $question->id;
                                $answer->answer_id = $answer_id;
                                $answer->applicant_id = $applicant->id;
                                $answer->save();
                            }else{
                                $forget = $answers2->where('answer_id',$answer_id);
                                $answers2 = $answers2->diff($forget);
                            }
                        }
                        foreach ($answers2 as $answer2){
                            $answer2->delete();
                        }
                    } else {
                        foreach ($answers as $answer_id) {
                            $answer = new ApplicantAnswer();
                            $answer->question_id = $question->id;
                            $answer->answer_id = $answer_id;
                            $answer->applicant_id = $applicant->id;
                            $answer->save();
                        }
                    }

                } else {
                    $answer = ApplicantAnswer::where('question_id', $question->id)->where('applicant_id', $applicant->id)->first();
                    if (empty($answer)) {
                        $answer = new ApplicantAnswer();
                    }

                    $answer->question_id = $question->id;
                    $answer->answer_id = $answers;
                    $answer->applicant_id = $applicant->id;
                    $answer->save();
                }
            } else {
                $answer = ApplicantAnswer::where('question_id', $question->id)->where('applicant_id', $applicant->id)->first();
                if (empty($answer)) {
                    $answer = new ApplicantAnswer();
                }
                $answer->question_id = $question->id;
                $answer->answer_text = $answers;
                $answer->applicant_id = $applicant->id;
                $answer->save();
            }

        }

        $last_page = QuestionnairePage::where('questionnaire_id', $this->questionnaire->id)->count();
        if ($applicant->current_page < $last_page) {
            $applicant->current_page = $applicant->current_page + 1;
            $applicant->save();

        } else {
            $applicant->current_page = 1;
            $applicant->save();
        }
        $next_page = $page + 1;


        return redirect($this->questionnaire->path . '/' . $next_page);
    }

    public function saveLast(Request $request)
    {

        $this->questionnaire = Questionnaire::getByPath($request);
        $this->questionnaire->checkSession($request);
        $applicant = Applicant::getApplicant($request);
        if ($applicant === NULL) {
            return redirect($this->questionnaire->path)->withErrors(['session' => __('Your session has expired. Please, log in again')]);
        }


        $applicant->questionnaire_completed = 1;
        $applicant->session_token = NULL;

        $applicant->save();

        $answers2 = ApplicantAnswer::where('applicant_id', $applicant->id)->get();
        foreach ($answers2 as $answer2) {
            $answer2->load('answers');
            $answer2->load('question');
        }

        // if (!empty($applicant->email)) {
        //         Mail::send('questionnaire.result_email', ['applicant' => $applicant, 'answers2' => $answers2, 'questionnaire' => $this->questionnaire], function ($message) use ($applicant) {
        //             $message->to($applicant->email, $applicant->name)->subject($this->questionnaire->confirmation_email_subject);
        //             $message->bcc('dkozlowski@teclado.pl');
        //             $message->getHeaders()
        //                 ->addTextHeader('Return-Path', 'dkozlowski@teclado.pl');
        //         });
        // }

        session()->flush();
        session()->regenerate(true);
        session()->save();
        return view('questionnaire.saved', [
            'applicant' => $applicant,
            'path' => $this->questionnaire->path,
            'questionnaire' => $this->questionnaire
        ]);
    }

    public function saveLast2(Request $request)
    {
        $this->questionnaire = Questionnaire::getByPath2($request);
        $this->questionnaire->checkSession2($request);
        $input = $request->except(['_token', 'send', 'email']);
        $applicant = Applicant::getApplicant2($request);
        if ($applicant === NULL) {
            return redirect($this->questionnaire->path)->withErrors(['session' => 'Twoja sesja wygasła - wpisz kod ponownie.']);
        }


        foreach ($input as $input_name => $answers) {
            $question = Question::where('input_name', $input_name)->get()->load('validations')->load('answers')->first();
            if ($question->validations->isNotEmpty()) {
                foreach ($question->validations as $validation) {
                    Validator::make(
                        $input,
                        [$input_name => $validation->rule],
                        [$input_name . '.' . $validation->rule_name => $validation->message])
                        ->validate();
                }
            }
            if ($question->answers->isNotEmpty()) {
                foreach ($question->answers as $answer) {
                    $answer->load('validations');
                    if ($answer->validations->isNotEmpty()) {
                        foreach ($answer->validations as $validation) {
                            Validator::make(
                                $input,
                                [$input_name . '.' . $answer->id => $validation->rule],
                                [$input_name . '.' . $answer->id . '.' . $validation->rule_name => $validation->message])
                                ->validate();
                        }
                    }
                }
                if (is_array($answers)) {
                    foreach ($answers as $answer_id) {
                        $answer = new ApplicantAnswer();
                        $answer->question_id = $question->id;
                        $answer->answer_id = $answer_id;
                        $answer->applicant_id = $applicant->id;
                        $answer->save();
                    }
                } else {
                    $answer = new ApplicantAnswer();
                    $answer->question_id = $question->id;
                    $answer->answer_id = $answers;
                    $answer->applicant_id = $applicant->id;
                    $answer->save();
                }
            } else {
                $answer = new ApplicantAnswer();
                $answer->question_id = $question->id;
                $answer->answer_text = $answers;
                $answer->applicant_id = $applicant->id;
                $answer->save();
            }

        }

        $applicant->questionnaire_completed = 1;
        $applicant->session_token = NULL;

        $applicant->save();

        $answers2 = ApplicantAnswer::where('applicant_id', $applicant->id)->get();
        foreach ($answers2 as $answer2) {
            $answer2->load('answers');
            $answer2->load('question');
        }

        if ($request->has('email')) {
            if (!empty($request->get('email'))) {
                $applicant->email = $request->get('email');
                $applicant->save();
                Mail::send('questionnaire.result_email', ['applicant' => $applicant, 'answers2' => $answers2], function ($message) use ($applicant) {
                    $message->to($applicant->email, $applicant->name)->subject('Potwierdzenie udziału w głosowaniu');
                    $message->bcc('dkozlowski@teclado.pl');
                    $message->getHeaders()
                        ->addTextHeader('Return-Path', 'dkozlowski@teclado.pl');
                });
            }

        }

        session()->flush();
        session()->regenerate(true);
        session()->save();
        return view('questionnaire.saved2', [
            'applicant' => $applicant,
            'path' => $this->questionnaire->path
        ]);
    }

    public function indexAdmin()
    {
        $questionnaire_id = auth()->user()->getCurrentQuestionnaire();
        if (empty($questionnaire_id) || Questionnaire::where('id', $questionnaire_id)->get()->isEmpty()){
            $questionnaire_id = Questionnaire::first()->id;
            auth()->user()->setCurrentQuestionnaire($questionnaire_id);
        }
        $questionnaire = Questionnaire::where('id',$questionnaire_id)->first();
        return view('questionnaire_page.index', ['questionnaire' => $questionnaire]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\QuestionnairePage $questionnairePage
     * @return \Illuminate\Http\Response
     */
    public function show(QuestionnairePage $questionnairePage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\QuestionnairePage $questionnairePage
     * @return \Illuminate\Http\Response
     */
    public function edit(QuestionnairePage $questionnairePage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\QuestionnairePage $questionnairePage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuestionnairePage $questionnairePage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\QuestionnairePage $questionnairePage
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuestionnairePage $questionnairePage)
    {
        //
    }
}
