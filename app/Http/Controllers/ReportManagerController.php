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

class ReportManagerController extends Controller
{   
    /**
     *Check if user is logged in
     *
     * @return Response
     */
	public function __construct()
    {
        $this->beforeFilter(function(){
            $value = Session::get('userid');
                if (empty($value)) {
                    return redirect('/../');
                }
        });
    }
    
    /**
     * Display the report history.
     *
     * @return Response
     */
    public function index()
    {
        $pracid = Session::get('userid');
        $pracinfo = Practitioner::find($pracid);
        $prac_reports = Report::latest('created_at')->practitioner()->get();

        $stepcount = Question::distinct()->lists('step');
        $progress = Report::latest('created_at')->practitioner()->progress()->get();
        $finished = Report::latest('created_at')->practitioner()->finished()->get();
        $shared = $pracinfo->reports()->get();
        dd($shared);

        return view('practitioner.reportmanager', compact('pracinfo', 'prac_reports', 'latestreport', 'stepcount', 'progress', 'finished', 'shared'));
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function overview($report_id)
    {
        $report = Report::find($report_id);
        $reportviewer = Session::get('userid');
        $reportowner = $report->prac_id;
        $reportstepcount = $report->questions()->distinct()->lists('step');
        $pracs = Practitioner::lists('name', 'id');
        $sharerslist = $report->practitioners()->get();

        return view('practitioner.reportoverview', compact('reportstepcount', 'report_id', 'report', 'reportowner', 'reportviewer', 'pracs', 'sharerslist'));
    }
}
