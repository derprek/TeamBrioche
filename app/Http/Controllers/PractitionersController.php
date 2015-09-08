<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use DB;
use Auth;
use Carbon\Carbon;
use App\Report;
use App\Question;
use App\Manager;
use App\Practitioner;
use App\User;
use App\Product;
use App\Tag;
use App\Category;
use App\Subcategory;


class PractitionersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {   
        if(!empty(Auth::User()->id)){
          Auth::logout();
        }    

        $value = Session::get('userid');
        if(empty($value))
        {
           return redirect('/../');
       }

       $clients = User::latest('created_at')->Myclient()->get();
       
       return view('practitioner.dashboard', compact ('clients'));
   }

    public function viewclient($id)
    {     
        $value = Session::get('userid');
        if(empty($value))
        {
           return redirect('/../');
       }

       $clientinfo = User::find($id);
       
       return view('practitioner.client', compact ('clientinfo'));
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    public function questionspage()
    {   
        $value = Session::get('userid');
        if(empty($value))
        {
           return redirect('/../');
       }

       $questionlist = Question::all();

       return view('practitioner.questions', compact('questionlist'));
   }

   public function addquestion()
   {
    $value = Session::get('userid');
    if(empty($value))
    {
       return redirect('/../');
   }

   $newquestion = $_POST['newquestion'];

   $newqn = new Question;
   $newqn->category = 'comment';
   $newqn->question = $newquestion;
   $newqn->created_at =Carbon::now();
   $newqn->save();

   return redirect('practitioner/questions' . '#qntable');
}
   
   public function history()
    {
      
        $value = Session::get('userid');
        if(empty($value))
        {
           return redirect('/../');
        }

       $pracid = Session::get('userid'); 
       $pracinfo = Practitioner::find($pracid);
       $prac_reports = Report::latest('created_at')->practitioner()->get();

       $stepcount = Question::distinct()->lists('step');
       $progress = Report::latest('created_at')->practitioner()->progress()->get();
       $finished = Report::latest('created_at')->practitioner()->finished()->get();
       $shared = $pracinfo->reports()->get();

       return view('practitioner.reportmanager', compact ('pracinfo', 'prac_reports', 'latestreport','stepcount', 'progress', 'finished','shared'));  
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function showStepOne($report_id)
    
    {   
        $value = Session::get('userid');
        if(empty($value))
        {
           return redirect('/../');
        }
        $report = Report::find($report_id);
        $clientinfo = User::find($report->userid);
        $pracinfo = Practitioner::find($report->prac_id);

        $arraycount = $report->questions()->distinct()->where('step','=',1)->orderBy('category_id','ASC')->lists('category_id');

         $answerlist = array();
          foreach($arraycount as $ans)
          {
            $answerlist[] = $report->questions()
                                   ->where('category_id','=', $ans)
                                   ->orderBy('type','DESC')
                                   ->get();
          }          
            
      return view('practitioner.show', compact('answerlist','report','clientinfo','pracinfo'));
    }
            

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */

    public function reportOverview($report_id)
    
    {   
        $report = Report::find($report_id);
        $reportviewer = Session::get('userid');
        $reportowner = $report->prac_id;
        $reportstepcount = $report->questions()->distinct()->lists('step');
        $pracs = Practitioner::lists('name','id');
        $sharerslist = $report->practitioners()->get();
       // dd($sharerslist[0]->pivot->prid);

      return view('practitioner.reportoverview', compact('reportstepcount','report_id','report','reportowner','reportviewer','pracs','sharerslist'));
       
    }

    public function edit($report_id)
    
    {

    }
  
    public function destroy($id)
    {
        //
    }

   

    public function generatereport($id)
    {        
       $value = Session::get('userid');
        if(empty($value))
        {
             return redirect('/../');
        }

        $report = Report::find($id);      

        $managers = DB::table('question_report')  //
        ->where('report_id', '=', $id)
        ->get();
        $questions = Question::all();

        return view('practitioner.test', compact('report','managers','questions'));   
    }

}
