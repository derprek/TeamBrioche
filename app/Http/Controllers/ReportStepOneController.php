<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Report;
use App\Question;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\User;
use Auth;
use Carbon\Carbon;
use Session;
use App\Practitioner;

/**
 * Class ReportStepOneController
 * @package App\Http\Controllers
 */
class ReportStepOneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $questions = Question::Stepone()->orderBy('category_id', 'ASC')->orderBy('type', 'DESC')->get();
        $clients = User::latest('created_at')->Myclient()->get();
        $questions_category = Question::Stepone()->distinct()->lists('category_id');

        $answerlist = array();
        foreach ($questions_category as $ans) {
            $answerlist[] = Question::Stepone()
                ->Getquestionsbycat($ans)
                ->orderBy('type', 'DESC')
                ->get();
        }

        if (!$clients->isEmpty()) {

        }
        return view('reports.create', compact('questions', 'clients', 'answerlist'));
    }

    /**
     * Store a report in step one.
     *
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

        $totalAnswers = count(Question::Stepone()->lists('id'));

        for ($a = 1; $a < $totalAnswers + 1; $a++) {
            $reports->questions()->attach($a, array('answers' => $_POST['answersid'][$a]));
        }

        return redirect('practitioner/reports');
    }

    /**
     * Display a report.
     *
     * @param $report_id
     * @return Response
     */
    public function show($report_id)

    {
        $value = Session::get('userid');
        if (empty($value)) {
            return redirect('/../');
        }
        $report = Report::find($report_id);
        $clientinfo = User::find($report->userid);
        $pracinfo = Practitioner::find($report->prac_id);

        $arraycount = $report->questions()->distinct()->Stepone()->orderBy('category_id', 'ASC')->lists('category_id');

        $answerlist = array();
        foreach ($arraycount as $ans) {
            $answerlist[] = $report->questions()
                ->Getquestionsbycat($ans)
                ->orderBy('type', 'DESC')
                ->get();
        }

        return view('practitioner.show', compact('answerlist', 'report', 'clientinfo', 'pracinfo'));
    }

    /**
     *
     * @return Redirect
     */
    public function update()
    {

        $value = Session::get('userid');
        if (empty($value)) {
            return redirect('/../');
        }

        $rqid = $_POST['rqid'];
        $reportid = $_POST['reportid'];
        $answer = $_POST['answersid'][$rqid];

        DB::update("update question_report set answers ='" . $answer . "' where rqid = ?", array($rqid));
        Session::flash('flash_message', 'Report successfully updated!');

        return redirect("reports/stepone/" . $reportid);
    }
}
