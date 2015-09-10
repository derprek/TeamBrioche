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

class ReportOverviewController extends Controller
{
    public function update()
    {
        $value = Session::get('userid');
        if (empty($value)) {
            return redirect('/../');
        }

        $reportid = $_POST['reportid'];
        $reports = Report::find($reportid);

        if (isset($_POST['ReportStatus'])) {
            $status = $_POST['ReportStatus'];
        } else {
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
