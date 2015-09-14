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
 * Class ReportOverviewController
 * @package App\Http\Controllers
 */
class ReportOverviewController extends Controller
{   
    /**
     *Check if user is logged in
     *
     * @return Response
     */
    public function __construct()
    {
        $this->beforeFilter(function(){
            $value = Session::get('prac_id');
                if (empty($value)) 
                {
                    return redirect('/../');
                }
        });
    }

    /**
     * Update a report.
     *
     * @return Redirect
     */
    public function update()
    {
        $reportid = $_POST['reportid'];
        $reports = Report::find($reportid);

        if (isset($_POST['ReportStatus'])) 
        {
            $status = $_POST['ReportStatus'];
        } 
        else 
        {
            $status = "In Progress";
        }

        $prac_notes = $_POST['prac_notes'];

        $reports->status = $status;
        $reports->updated_at = Carbon::now();
        $reports->prac_notes = $prac_notes;

        $reports->save();

        Session::flash('banner_message', 'Report successfully updated!');
        return redirect("practitioner/overview/" . $reportid);
    }
}
