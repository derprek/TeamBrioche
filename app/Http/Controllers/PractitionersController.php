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


/**
 * Class PractitionersController
 * @package App\Http\Controllers
 */
class PractitionersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $value = Session::get('userid');
        if (empty($value)) {
            return redirect('/../');
        }

        return view('practitioner.dashboard');
    }

    /**
     * view  a client
     *
     * @param $id
     * @return Response
     */
    public function viewclient($id)
    {
        $value = Session::get('userid');
        if (empty($value)) {
            return redirect('/../');
        }

        $clientinfo = User::find($id);

        return view('practitioner.client', compact('clientinfo'));
    }

    /**
     * Show the form for creating a new question.
     *
     * @return Response
     */
    public function questionspage()
    {
        $value = Session::get('userid');
        if (empty($value)) {
            return redirect('/../');
        }

        $questionStepOne = Question::Stepone()->get();
        $questionStepTwo = Question::Steptwo()->get();

        return view('practitioner.questions', compact('questionStepOne', 'questionStepTwo'));
    }

    /**
     * Display the report history.
     *
     * @return Response
     */
    public function history()
    {

        $value = Session::get('userid');
        if (empty($value)) {
            return redirect('/../');
        }

        $pracid = Session::get('userid');
        $pracinfo = Practitioner::find($pracid);
        $prac_reports = Report::latest('created_at')->practitioner()->get();

        $stepcount = Question::distinct()->lists('step');
        $progress = Report::latest('created_at')->practitioner()->progress()->get();
        $finished = Report::latest('created_at')->practitioner()->finished()->get();
        $shared = $pracinfo->reports()->get();

        return view('practitioner.reportmanager', compact('pracinfo', 'prac_reports', 'latestreport', 'stepcount', 'progress', 'finished', 'shared'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function reportOverview($report_id)

    {
        $report = Report::find($report_id);
        $reportviewer = Session::get('userid');
        $reportowner = $report->prac_id;
        $reportstepcount = $report->questions()->distinct()->lists('step');
        $pracs = Practitioner::lists('name', 'id');
        $sharerslist = $report->practitioners()->get();

        return view('practitioner.reportoverview', compact('reportstepcount', 'report_id', 'report', 'reportowner', 'reportviewer', 'pracs', 'sharerslist'));

    }

    /**
     * Generate a report.
     *
     * @param $id
     * @return Response
     */
    public function generatereport($id)
    {
        $value = Session::get('userid');
        if (empty($value)) {
            return redirect('/../');
        }
        $report = Report::find($id);
        $managers = DB::table('question_report')//
        ->where('report_id', '=', $id)
            ->get();
        $questions = Question::all();
        return view('practitioner.test', compact('report', 'managers', 'questions'));
    }


}
