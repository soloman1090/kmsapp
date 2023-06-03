<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AppPaginator;
use App\Http\Controllers\Controller;
use App\Models\Survey;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $AppPaginator = new AppPaginator;
        $priviledge = "admin";
        $survey = Survey::join('users', 'users.id', '=', 'survey.user_id')
        ->orderBy('survey.id','DESC')
        ->get(['users.id as user_id','users.name as username','users.email', 'survey.support','survey.withdrawals',
            'survey.deposits','survey.functions','survey.comments','survey.id as survey_id', ]);
        $surveyInfo = Survey::where('id', 1)->get()->first();

        $supportOkay=0;
        $withdrawalsOkay=0;
        $depositsOkay=0;
        $functionsOkay=0;

        $supportImprove=0;
        $withdrawalsImprove=0;
        $depositsImprove=0;
        $functionsImprove=0;

        foreach ($survey as $key => $sur) {
            if($sur->support=="Yes"){
                $supportImprove=$supportImprove+1;
            }
            // else{
            //     $supportOkay=$supportOkay+1;
            // }

            if($sur->withdrawals=="No"){
                $withdrawalsImprove=$withdrawalsImprove+1;
            }
            // else{
            //     $withdrawalsOkay=$withdrawalsOkay+1;
            // }

            if($sur->deposits=="Maybe"){
                $depositsImprove=$depositsImprove+1;
            }
            // else{
            //     $depositsOkay=$depositsOkay+1;
            // }

            // if($sur->functions=="Yes"){
            //     $functionsImprove=$functionsImprove+1;
            // }else{
            //     $functionsOkay=$functionsOkay+1;
            // }
        }


        $myCollectionObj1 = collect($survey);
        $survey = $AppPaginator->paginate($myCollectionObj1, 'admin/surveys');

        $arrayOkay=[$supportOkay, $withdrawalsOkay, $depositsOkay, $functionsOkay];
        $arrayImprove=[$supportImprove, $withdrawalsImprove, $depositsImprove, $functionsImprove];


        return view('admin.surveys', ["surveyInfo"=>$surveyInfo, 'surveys' => $survey,"priviledge" => $priviledge, 'page_title' => "Members Feedback", "arrayOkay"=>$arrayOkay, "arrayImprove"=>$arrayImprove]
        );
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
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function show(Survey $survey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function edit(Survey $survey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Survey $survey)
    {
        $survey->support=$request['yes'];
        $survey->withdrawals=$request['no'];
        $survey->deposits=$request['maybe'];
        $survey->update();
        $request->session()->flash('success', 'Survey Updated');
        return redirect("admin/surveys");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function destroy(Survey $survey)
    {
        //
    }
}
