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
use App\SubcategoryF;


class PractitionersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {   
        
        $value = Session::get('userid');
        if(empty($value))
        {
           return redirect('/../');
       }

       $prac_reports = Report::all();
       $userid =  Session::get('userid');
       $pracinfo = Practitioner::find($userid);
       
       $latestreport = Report::where('step','=','1')->orderBy('updated_at', 'desc')->first();

       $pending = Report::where('status', '=' , 'Pending Review')->get();
       $progress = Report::where('status', '=' , 'In Progress')->get();
       $finished = Report::where('status', '=' , 'Finished')->get();

       return view('practitioner.dashboard', compact ('pracinfo', 'prac_reports', 'latestreport','pending', 'progress', 'finished'));
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

    public function questionspage()
    {   
        $value = Session::get('userid');
        if(empty($value))
        {
           return redirect('/../');
       }

       $questionlist = Question::all();

       return view('practitioner.questions', compact('questionlist'));
   }

   public function addquestion()
   {
    $value = Session::get('userid');
    if(empty($value))
    {
       return redirect('/../');
   }

   $newquestion = $_POST['newquestion'];

   $newqn = new Question;
   $newqn->category = 'comment';
   $newqn->question = $newquestion;
   $newqn->created_at =Carbon::now();
   $newqn->save();

   return redirect('practitioner/questions' . '#qntable');
}

public function addproduct()
{

<<<<<<< HEAD
        $value = Session::get('userid');
        if(empty($value))
        {
             return redirect('/../');
        }

        $prodtags = $_POST['tag_list'];
        dd($prodtags);
        $newprodname = $_POST['prodname'];
        $newprodmanu = $_POST['prodmanu'];
        $newprodcat = $_POST['prodcat'];
        $newprodprice = $_POST['prodprice'];

        $newprod = new Product;
            $newprod->name = $newprodname;
            $newprod->manufactorer = $newprodmanu;
            $newprod->category = $newprodcat;
            $newprod->price = $newprodprice;
            $newprod->updated_on = Carbon::now();
            $newprod->save();

        return redirect('practitioner/productsmanager' . '#prodtable');
    }
=======
    $value = Session::get('userid');
    if(empty($value))
    {
       return redirect('/../');
   }

   $newprodname = $_POST['prodname'];
   $newprodmanu = $_POST['prodmanu'];
   $newprodcat = $_POST['prodcat'];
   $newprodprice = $_POST['prodprice'];

   $newprod = new Product;
   $newprod->name = $newprodname;
   $newprod->manufactorer = $newprodmanu;
   $newprod->category = $newprodcat;
   $newprod->price = $newprodprice;
   $newprod->updated_on = Carbon::now();
   $newprod->save();

   return redirect('practitioner/productsmanager' . '#prodtable');
}
>>>>>>> 3c00e1864af4c1527a437ba6531445b18f6cbd47

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {   
        $value = Session::get('userid');
        if(empty($value))
        {
           return redirect('/../');
       }

       $reportid = $_POST['reportid'];
       $report = Report::find($reportid);

       if(empty($_POST['productlist'])){
        
        echo "hi";

    }

<<<<<<< HEAD


         else{
=======
    else{
>>>>>>> 3c00e1864af4c1527a437ba6531445b18f6cbd47

        $addnewitems = $_POST['productlist'];

        $productsarraycounter = count($addnewitems);

        for($x = 0; $x < $productsarraycounter; $x++) {

         $report->products()->attach($addnewitems[$x], array('request_by' => 'Practitioner'));
         
     }

     return redirect('practitioner/' . $reportid . '#recommendproducttable');
 }

}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($report_id)
    
    {   
        $value = Session::get('userid');
        if(empty($value))
        {
           return redirect('/../');
       }

        $managers = DB::table('question_report')  //
        ->where('report_id', '=', $report_id)
        ->get();

        $questions = Question::lists('question')->toArray(); // $questions[1];
        $questionlistlength = count($questions);

        $reports = Report::find($report_id);  

        $client = User::find($reports->userid);

        // Retrieve Patient Products
        $patientproductslist = DB::table('product_report')  //
        ->where('report_id', '=', $report_id)
        ->where('request_by','=', 'Patient')
                ->get();  //array

                $patproductarray = array();
                foreach($patientproductslist as $patproductlist)
                {
                    $patproductarray[] = Product::find($patproductlist->product_id);
                }
        // End 

        // Retrieve Prac Products
        $pracproductslist = DB::table('product_report')  //
        ->where('report_id', '=', $report_id)
        ->where('request_by','=', 'Practitioner')
                ->get();  //array

                $pracproductarray = array();
                foreach($pracproductslist as $pracproductlist)
                {
                    $pracproductarray[] = Product::find($pracproductlist->product_id);
                }
        // End
                

                return view('practitioner.show', compact('questions', 'reports', 'client','managers','questionlistlength','patproductarray','pracproductarray'));
            }
            

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($report_id)
    
    {

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update()
    {
        $value = Session::get('userid');
        if(empty($value))
        {
           return redirect('/../');
       }

       $reportid = $_POST['reportid'];
       $reports = Report::find($reportid);

       $updatestatus =  $_POST['ReportStatus'];

       dd($_POST['prac_notes']);
       $prac_notes =  $_POST['prac_notes'];

       $reports->status = $updatestatus;
       $reports->updated_at = Carbon::now();
       $reports->prac_notes = $prac_notes;
       
       $reports->save();

       return redirect('practitioner/dashboard');
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

    public function addproductspage()
    {
        $value = Session::get('userid');
        if(empty($value))
        {
           return redirect('/../');
       }

       $products = Product::all();
       return view('practitioner.products', compact('products'));
   }

<<<<<<< HEAD
    public function productsmanager()  //load product manager page
=======
   public function productsmanager()
   {
    $value = Session::get('userid');
    if(empty($value))
>>>>>>> 3c00e1864af4c1527a437ba6531445b18f6cbd47
    {
       return redirect('/../');
   }

<<<<<<< HEAD
        $categories = Category::all();
        $tags = Tag::lists('name');
        $productsmanager = Product::all();
        return view('practitioner.productsmanager', compact('productsmanager', 'tags','categories'));
    }

    public function generatereport($id)
    {        
       $value = Session::get('userid');
        if(empty($value))
        {
             return redirect('/../');
        }

        $report = Report::find($id);      
=======
   $productsmanager = Product::all();
   return view('practitioner.productsmanager', compact('productsmanager'));
}

public function generatereport($id)
{        
 $value = Session::get('userid');
 if(empty($value))
 {
   return redirect('/../');
}

$report = Report::find($id);      
>>>>>>> 3c00e1864af4c1527a437ba6531445b18f6cbd47
        $managers = DB::table('question_report')  //
        ->where('report_id', '=', $id)
        ->get();
        $questions = Question::all();

        return view('practitioner.test', compact('report','managers','questions'));   
    }

}
