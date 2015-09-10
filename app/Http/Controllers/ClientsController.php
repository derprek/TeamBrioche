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
use Auth;
use Carbon\Carbon;
use Session;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (Auth::guest()) {

            return redirect('auth/login');
        }

        if (Session::has('userid')) {
            Session::reflash();
            return redirect('practitioner/dashboard');
        }


        $reports = Report::where('userid', '=', Auth::User()->id)->orderBy('updated_at', 'desc')->first();
        $reporthistory = Report::where('userid', '=', Auth::User()->id)->get();

        if (empty($reports->id)) {

        } else {

            $latestreport = Report::where('userid', '=', Auth::User()->id)->orderBy('updated_at', 'desc')->first();

            // Get report and its qns/ans
            $questionreport = $latestreport->questions()
                ->where('report_id', '=', $latestreport->id)
                ->get();

            $questionlist = array();
            $answerlist = array();
            foreach ($questionreport as $ans) {
                $questionlist[] = Question::find($ans->pivot->question_id);
                $answerlist[] = $ans->pivot->answers;
            }

            $qrarraylength = count($answerlist);
            // End

        }

        return view('client.index', compact('reports', 'reporthistory', 'products', 'latestreport', 'answerlist', 'questionlist', 'qrarraylength'));

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
