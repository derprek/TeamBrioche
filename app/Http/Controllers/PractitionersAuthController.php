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
     * Authenticates the user
     *
     * @return Response
     */
    public function login()
    {

        $password = MD5($_POST['password']);
        $email = $_POST['email'];

        $loginchecker = Practitioner::ValidateEmail($email)->ValidatePassword($password)->get();

        if (empty($loginchecker[0])) {

           $errors[] = "Invalid Credentials. Please try again!"; 
           return Redirect()->back()->withErrors($errors);  

        } else {
            $matchme = ['email' => $email, 'password' => $password];

            $practitionerinfo = Practitioner::where($matchme)->firstOrFail();
            Session::put('prac_id', $practitionerinfo->id);
            Session::put('prac_name', $practitionerinfo->name);

            return redirect('practitioner/dashboard');

        }
    }
    /**
     * Logs the user out
     *
     * @return Response
     */
    public function logout()
    {
        Session::flush();
        return redirect('/../');
    }
}
