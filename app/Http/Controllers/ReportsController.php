<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Report;
use App\Question;
use App\Manager;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
       $reports = Report::all();

        return view('reports.index', compact ('reports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $questions = Question::all();
       
      //  $managers = Manager::all();
       return view('reports.create', compact('questions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //$input = Request::all();
        //$input['published_at'] = Carbon::now();
        //Article::create($input);

        //Article::create(Request::all());
        //dd($request->input('tags'));
       // $article = Auth::user()->articles()->create($request->all());
      //  $article->tags()->attach($request->input('tag_list'));



      //  return redirect('reports');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($report_id)
    {
       $managers = DB::table('question_report')
                ->where('report_id', '=', $report_id)
                ->get();
       // $manager = Manager::find($report_idz);
        return view('reports.show', compact('managers'));



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
