<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
<<<<<<< HEAD

use Session;
=======
>>>>>>> 3c00e1864af4c1527a437ba6531445b18f6cbd47
use App\Report;
use App\Question;
use App\Manager;
use App\Product;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
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

    public function _construct(){


    }

    public function index()
    {

     if(Auth::guest()){

        return redirect('/../auth/login');
    }

    $reports = Report::where('userid', '=', Auth::User()->id)->get();

    $latestreport = Report::where('userid', '=', Auth::User()->id)->orderBy('updated_at', 'desc')->first();

    if(empty($latestreport->id))
    {
        $dummyreport = New Report;
        $dummyreport->userid = Auth::User()->id;
        $dummyreport->step = '0';
        $dummyreport->date = Carbon::now();
        $dummyreport->status = 'Dummy Record';
        $dummyreport->prac_notes = 'dummy record';
        $dummyreport->created_at = Carbon::now();
        $dummyreport->save();
        $latestreport = Report::where('userid', '=', Auth::User()->id)->orderBy('updated_at', 'desc')->first();

    }

    if($latestreport->status == 'Dummy Record')
    {

    }

    else
    {
        $managers = DB::table('question_report')  //
        ->where('report_id', '=', $latestreport->id)
        ->get();

        $questions = Question::lists('question')->toArray();
        $questionslength = count($questions);

        // Retrieve Patient Products
        $patientproductslist = DB::table('product_report')  //
        ->where('report_id', '=', $latestreport->id)
        ->where('request_by','=', 'Patient')
                ->get();  //array

                $patproductarray = array();
                foreach($patientproductslist as $patproductlist)
                {
                    $patproductarray[] = Product::find($patproductlist->product_id);
                }
        // End 

        // Retrieve Prac Products
        $pracproductslist = DB::table('product_report')  //
        ->where('report_id', '=', $latestreport->id)
        ->where('request_by','=', 'Practitioner')
                ->get();  //array

                $pracproductarray = array();
                foreach($pracproductslist as $pracproductlist)
                {
                    $pracproductarray[] = Product::find($pracproductlist->product_id);
                }
        // End

        //dd($productlist[0]->name);
            }
            return view('reports.index', compact ('reports', 'products','latestreport','managers','questions','questionslength','patproductarray','pracproductarray'));
        }

        public function newproducts()
        {
            if(Auth::guest()){

                return redirect('/../auth/login');
            }

            $reports = Report::where('userid', '=', Auth::User()->id)->get();
            $latestreport = Report::where('userid', '=', Auth::User()->id)->orderBy('date', 'desc')->first();
            $products = Product::all();

            return view('reports.newproducts', compact ('reports', 'products','latestreport'));
        }

        public function userhistory()
        {
            if(Auth::guest()){

                return redirect('/../auth/login');
            }

            $reports = Report::where('userid', '=', Auth::User()->id)->where('status','!=','Dummy Record')->get();

            return view('reports.userhistory', compact ('reports'));
        }

     public function addnewproducts()  //add products
     {
        if(Auth::guest()){

            return redirect('/../auth/login');
        }

        $latestreport = Report::where('userid', '=', Auth::User()->id)->orderBy('date', 'desc')->first();
        $latestreportid = $latestreport->id;

        if(empty($_POST['productlist'])){

           return redirect('reports' . '#producttable');

       }

       else{

        $addnewitems = $_POST['productlist'];

        $productsarraycounter = count($addnewitems);

        for($x = 0; $x < $productsarraycounter; $x++) {

            $latestreport->products()->attach($addnewitems[$x], array('request_by' => 'Patient'));

        }

        return redirect('reports/' . '#menu1');
    }
}
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if(Auth::guest()){

            return redirect('/../auth/login');
        }
        $questions = Question::all();

      //  $managers = Manager::all();
        return view('reports.create', compact('questions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store()
    {   
        $finalanswers1 = Session::get('answer1');
        $finalanswers2 = Session::get('answer2');
        $finalanswers3 = Session::get('answer3');
        $finalanswers4 = Session::get('answer4');
        $finalanswers5 = Session::get('answer5');
        $finalanswers6 = Session::get('answer6');
        $finalanswers7 = Session::get('answer7');
        $finalanswers8 = Session::get('answer8');
        $finalanswers9 = Session::get('answer9');

        $AnswerArray = array($finalanswers1,$finalanswers2,$finalanswers3,$finalanswers4,$finalanswers5,$finalanswers6,$finalanswers7,$finalanswers8,$finalanswers9);
        $userid = Auth::User()->id;
       // $arrayAnswer = array('1');
        //dd($username);
        
<<<<<<< HEAD
                    $reports = new Report;
                    $reports->userid = $userid;
                    $reports->step = '1';
                    $reports->date = Carbon::now();
                    $reports->status = 'Pending Review';
                    $reports->updated_at = Carbon::now();
                    $reports->save();
                  
=======
        $reports = new Report;
        $reports->userid = $userid;
        $reports->step = '1';
        $reports->date = Carbon::now();
        $reports->status = 'Pending Review';
        $reports->updated_at = Carbon::now();
        $reports->save();

>>>>>>> 3c00e1864af4c1527a437ba6531445b18f6cbd47
        $reportid = Report::where('userid', $userid)->orderBy('date', 'desc')->first();

        $arraycounter = count($AnswerArray);
        $qncounter = 1;

         for($x = 0; $x < $arraycounter; $x++) {

            DB::table('question_report')->insert(
                array('report_id' =>  $reportid->id , 
                  'question_id'   =>   Question::find($qncounter)->id,
                  'created_at'   =>   Carbon::now(), 
                  'answers' =>    $AnswerArray[$x])
<<<<<<< HEAD

                );
            $qncounter++;
        }
        
       return redirect('reports');
=======

                );
            $qncounter++;
        }

        return redirect('reports');
>>>>>>> 3c00e1864af4c1527a437ba6531445b18f6cbd47
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
        if(Auth::guest()){

            return redirect('/../auth/login');
        }

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

 public function notloggedin()
 {


 }

<<<<<<< HEAD
        Session::put('answer1', $_POST['answersid1']);
        Session::put('answer2', $_POST['answersid2']);
        Session::put('answer3', $_POST['answersid3']);
        Session::put('answer4', $_POST['answersid4']);
        Session::put('answer5', $_POST['answersid5']);
        Session::put('answer6', $_POST['answersid6']);
        Session::put('answer7', $_POST['answersid7']);
        Session::put('answer8', $_POST['answersid8']);
        Session::put('answer9', $_POST['answersid9']);

        $answers1 = $_POST['answersid1'];
        $answers2 = $_POST['answersid2'];
        $answers3 = $_POST['answersid3'];
        $answers4 = $_POST['answersid4'];
        $answers5 = $_POST['answersid5'];
        $answers6 = $_POST['answersid6'];
        $answers7 = $_POST['answersid7'];
        $answers8 = $_POST['answersid8'];
        $answers9 = $_POST['answersid9'];
=======
 public function summary()
 {
     if(Auth::guest()){
>>>>>>> 3c00e1864af4c1527a437ba6531445b18f6cbd47

        return redirect('/../auth/login');
    }

    Session::put('answer1', $_POST['answersid1']);
    Session::put('answer2', $_POST['answersid2']);
    Session::put('answer3', $_POST['answersid3']);
    Session::put('answer4', $_POST['answersid4']);
    Session::put('answer5', $_POST['answersid5']);
    Session::put('answer6', $_POST['answersid6']);
    Session::put('answer7', $_POST['answersid7']);
    Session::put('answer8', $_POST['answersid8']);
    Session::put('answer9', $_POST['answersid9']);

    $answers1 = $_POST['answersid1'];
    $answers2 = $_POST['answersid2'];
    $answers3 = $_POST['answersid3'];
    $answers4 = $_POST['answersid4'];
    $answers5 = $_POST['answersid5'];
    $answers6 = $_POST['answersid6'];
    $answers7 = $_POST['answersid7'];
    $answers8 = $_POST['answersid8'];
    $answers9 = $_POST['answersid9'];

    $arrayAnswer = array($answers1,$answers2,$answers3,$answers4,$answers5,$answers6,$answers7,$answers8,$answers9);

    $questions = Question::lists('question');
    $questions->toArray();

    return view('reports.summary', compact('arrayAnswer', 'questions'));
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
