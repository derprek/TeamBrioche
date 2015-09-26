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

class QuestionManagerController extends Controller
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
     * Show the form for creating a new question.
     *
     * @return Response
     */
    public function index()
    {
        $assessment_qns = Question::Assessment()->get();
        $typology_qns = Question::Typology()->get();

        return view('practitioner.questionmanager', compact('assessment_qns', 'typology_qns'));
    }
}
