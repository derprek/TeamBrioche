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
            $value = Session::get('prac_id');
                if (empty($value)) {
                    return redirect('/../');
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

        Session::flash('banner_message', "Report is now shared!");
        return redirect("practitioner/overview/" . $reportid);

    }

    /**
     * Remove a sharer in the report.
     *
     * @return Redirect
     */
    public function removeSharer()
    {
        $reportid = $_POST['reportid'];
        $prid = $_POST['prid'];

        $report = Report::find($reportid);
        $prac = $report->practitioners()->get();
        $pracname = $prac[0]->name;

        $report->practitioners()
            ->newPivotStatement()
            ->where('prid', '=', $prid)
            ->delete();

        Session::flash('banner_message', " $pracname has been removed from the sharing list.");
        return redirect("practitioner/overview/" . $reportid);
    }
}
