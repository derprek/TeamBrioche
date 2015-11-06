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
     * controls the adding of sharers to a report
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
     * controls the deletion of sharers to a report
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
}
