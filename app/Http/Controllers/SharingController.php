<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use App\Report;
use App\Practitioner;
use App\User;
use Session;

/**
 * Class SharingController
 * @package App\Http\Controllers
 */
class SharingController extends Controller
{   
    /**
     *Check if user is logged in
     *
     * @return Response
     */
    public function __construct()
    {
        $this->beforeFilter(function(){
           
                if (!Session::has('prac_id'))
                {
                    return redirect('/unauthorizedaccess');
                }
        });
    }
    
    /**
     * Add a new sharer to report.
     *
     * @return Response
     */
    public function addNewSharer()
    {
        $newsharers = $_POST['prac_list'];
        $reportid = $_POST['reportid'];

        $report = Report::find($reportid);

        foreach ($newsharers as $prac) {
            $report->practitioners()->attach($prac);
        }

        Session::flash('banner_message', "Report successfully shared.");
        return redirect("reports/overview/" . $reportid);

    }

    /**
     * Remove a sharer in the report.
     *
     * @return Redirect
     */
    public function removeSharer()
    {
        $reportid = $_POST['report_id'];
        $prac_id = $_POST['prac_id'];

        $report = Report::find($reportid);
        $practitioner = Practitioner::find($prac_id);
        $prac_email = $practitioner->email;

        $report->practitioners()
            ->newPivotStatement()
            ->where('practitioner_id', '=', $prac_id)
            ->where('report_id', '=', $reportid)
            ->delete();

        Session::flash('banner_message', " $prac_email has been removed from the sharing list.");
        return redirect("reports/overview/" . $reportid);
    }

    public function getUnsharedPractitioners()
    {
        $praclist = DB::table('practitioners')
        ->whereNotExists(function($query)
        {
            $query->select(DB::raw(1))
                  ->from('practitioner_report')
                  ->where('report_id','=',4)
                  ->whereRaw('practitioner_report.practitioner_id = practitioners.id');
        })
        ->lists('email');

        dd($praclist);

      $prac_reports = Report::latest('updated_at')->practitioner()->get();

        $reportlist = array();
        foreach($prac_reports as $report)
        {       
            $username = User::find($report->userid);
           
            $reportlist[] = ['id'=>$report->id,
                                'name'=>$username->fname . " " . $username->sname,
                                'updated_at'=>$report->updated_at->diffForHumans(),
                                'status'=>$report->status,
                                'created_at'=>$report->created_at->diffForHumans()];
                      
        }

        if(count($reportlist) < 1)
        {
            return null;
        }
        else
        {   
            return $reportlist;
        }
    }
}
