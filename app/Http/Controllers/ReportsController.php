<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Report;
use App\Question;
use App\Manager;
use App\Product;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use Auth;
use Carbon\Carbon;
use Session;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index()
    {

    }

    public function userhistory()
        {

            $reports = Report::where('userid', '=', Auth::User()->id)->where('status','!=','Dummy Record')->get();

            return view('reports.userhistory', compact ('reports'));
        }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        
        $questions = Question::where('step','=',1)->orderBy('category_id','ASC')->orderBy('type','DESC')->get();
        $clients = User::latest('created_at')->Myclient()->get(); 
        $questions_category= Question::where('step','=',1)->distinct()->lists('category_id');

         $answerlist = array();
            foreach($questions_category as $ans)
            {
                $answerlist[] = Question::where('step','=',1)
                                ->where('category_id','=', $ans)
                                ->orderBy('type','DESC')
                                ->get();
            }

        if(!$clients->isEmpty()){

        }
        return view('reports.create', compact('questions','clients','answerlist'));
    }

     
    public function createsteptwo($report_id)
    {   
        $questions = Question::where('step','=',2)->orderBy('category_id','ASC')->orderBy('type','DESC')->get();
        $clients = User::latest('created_at')->Myclient()->get(); 
        $questions_category= Question::where('step','=',2)->distinct()->lists('category_id');
        $usergoals = Report::find($report_id)->questions()
                                             ->where('question','=',"Client's goals")
                                             ->lists('answers');

         $questionslist = array();
            foreach($questions_category as $ans)
            {
                $questionslist[] = Question::where('step','=',2)
                                ->where('category_id','=', $ans)
                                ->orderBy('type','DESC')
                                ->get();
            }

      //  $managers = Manager::all();
        return view('reports.createsteptwo', compact('questions','clients','questionslist','report_id'));
    }

     public function storeStepTwo()
    {   
        $report_id = $_POST['reportid'];
        $report = Report::find($report_id);
        $totalAnswers = count(Question::where('step','=',2)->lists('id'));
        $questioncount = Question::where('step','=',2)->lists('id');
        $answerlist = array();


        foreach($questioncount as $questionid)
        {
           $report->questions()->attach($questionid, array('answers' => $_POST['answersid'][$questionid]));
        }

        $reportstepcount = $report->questions()->distinct()->lists('step');

      return view('practitioner.reportoverview', compact('reportstepcount','report_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store()
    { 
        
        $client = $_POST['client'];
        $pracid = Session::get('userid');

        $reports = new Report;
        $reports->userid = $client;
        $reports->step = '1';
        $reports->date = Carbon::now();
        $reports->status = 'Pending Review';
        $reports->prac_id = $pracid;
        $reports->updated_at = Carbon::now();
        $reports->save();

        $totalAnswers = count(Question::where('step','=',1)->lists('id'));

        for($a = 1; $a < $totalAnswers+1; $a++) 
        {
             $reports->questions()->attach($a, array('answers' => $_POST['answersid'][$a]));
        }

        return redirect('practitioner/dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($report_id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($report_id)
    {

        $managers = DB::table('question_report')  //
        ->where('report_id', '=', $report_id)
        ->get();
        $questions = Question::all(); // $questions[1];
        $reports = Report::find($report_id);
       // $manager = Manager::find($report_idz);
        return view('reports.edit', compact('managers', 'questions', 'reports'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Report $reports)
    {  
     return redirect('/../');

     }

    public function pracAnswersUpdate()
    {  

    $value = Session::get('userid');
        if(empty($value))
        {
        return redirect('/../');
    }
     
     $rqid = $_POST['rqid'];
     $reportid = $_POST['reportid'];
     $answer = $_POST['answersid'][$rqid];

    DB::update("update question_report set answers ='" . $answer. "' where rqid = ?", array($rqid));
    Session::flash('flash_message', 'Report successfully updated!');

    return redirect("practitioner/" . $reportid);
    }

    public function pracSubUpdates()
    {
        $value = Session::get('userid');
        if(empty($value))
        {
           return redirect('/../');
       }

       $reportid = $_POST['reportid'];
       $reports = Report::find($reportid);

       $updatestatus =  $_POST['ReportStatus'];

       $prac_notes =  $_POST['prac_notes'];

       $reports->status = $updatestatus;
       $reports->updated_at = Carbon::now();
       $reports->prac_notes = $prac_notes;
       
       $reports->save();

       Session::flash('flash_message', 'Report successfully updated!');
       return redirect("practitioner/" . $reportid);
    }

     public function summary()
     {
      
     }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return Response
         */
        public function destroy($id)
        {
            //
        }
    }
