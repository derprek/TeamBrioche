<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Practitioner;
use App\Report;
use App\Question;
use Session;
use Carbon\Carbon;

/**
 * Class PractitionersAuthController
 * @package App\Http\Controllers
 */
class PractitionersAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('login.practitioner', compact('reports'));
    }

    public function showregisterpage()
    {
        return view('login.pracregister', compact('reports'));
    }


    public function registration()
    {
        return view('auth.registration');
    }

    public function showlogin()
    {
        return view('login.login');
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

    public function register()
    {
        $pracname = $_POST['name'];
        $pracemail = $_POST['email'];
        $pracpw = $_POST['password'];

        $emailchecker = Practitioner::where('email', '=', $pracemail)->get();

        if (empty($emailchecker[0])) {
            $newPrac = New Practitioner;
            $newPrac->name = $pracname;
            $newPrac->email = $pracemail;
            $newPrac->usertype = 'Admin';
            $newPrac->password = MD5($pracpw);
            $newPrac->created_at = Carbon::now();
            $newPrac->save();

            $matchme = ['email' => $pracemail, 'password' => MD5($pracpw)];

            $practitionerinfo = Practitioner::where($matchme)->firstOrFail();
            Session::put('userid', $practitionerinfo->id);

            return Redirect::action('PractitionersController@index');
        } else {

            $errors[] = 'Email already exists';
            return view('login.pracregister', compact('errors'));
        }


    }

    public function login()
    {

        $password = MD5($_POST['password']);
        $email = $_POST['email'];

        $loginchecker = Practitioner::where('email', '=', $email)->where('password', '=', $password)->get();

        if (empty($loginchecker[0])) {
            $errors[] = 'Invalid Credentials';
            return view('login.practitioner', compact('errors'));
        } else {
            $matchme = ['email' => $email, 'password' => $password];

            $practitionerinfo = Practitioner::where($matchme)->firstOrFail();
            Session::put('userid', $practitionerinfo->id);
            $prac_reports = Report::all();

            return redirect('practitioner/dashboard');

        }
        // return view('practitioner.dashboard', compact ('practitionerinfo', 'prac_reports'));
    }

    public function logout()
    {
        Session::flush();
        return redirect('/../');
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
