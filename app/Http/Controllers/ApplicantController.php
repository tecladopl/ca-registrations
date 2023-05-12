<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Questionnaire;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function show(Applicant $applicant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function edit(Applicant $applicant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Applicant $applicant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Applicant $applicant)
    {
        //
    }

    public function indexAdmin()
    {
        $questionnaire_id = auth()->user()->getCurrentQuestionnaire();
        if (empty($questionnaire_id) || Questionnaire::where('id', $questionnaire_id)->get()->isEmpty()){
            $questionnaire = Questionnaire::first();
            if(!empty($questionnaire)){
                $questionnaire_id = $questionnaire->id;
                auth()->user()->setCurrentQuestionnaire($questionnaire_id);
            }
            
        }


        $applicants = Applicant::where('questionnaire_id', $questionnaire_id)->with('questionnaireParticipant')->get();
        //$questionnaire = Questionnaire::where('id',$questionnaire_id)->first();

        return view('applicants.index', ['applicants' => $applicants]);
    }
}
