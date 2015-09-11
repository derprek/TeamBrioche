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

/**
 * Class PractitionersClientManagerController
 * @package App\Http\Controllers
 */
class PractitionersClientManagerController extends Controller
{
    //

    /**
     * Display the list of clients.
     *
     * @return Response
     */
    public function index()
    {
        $value = Session::get('userid');
        if (empty($value)) {
            return redirect('/../');
        }
        $clients = User::latest('created_at')->Myclient()->get();
        return view('practitioner.clientmanager', compact('clients'));

    }

    /**
     *Store client information.
     *
     * @return Response
     */
    public function store()
    {
        $pracid = Session::get('userid');
        $user = new User;
        $user->fname = $_POST['fname'];
        $user->sname = $_POST['sname'];
        $user->email = $_POST['email'];
        $user->gender = $_POST['gender'];
        $user->prac_id = $pracid;
        $user->password = bcrypt($_POST['password']);
        $user->save();
        return redirect("practitioner/clientmanager/");
        Session::flash('flash_message', 'Client was successful registered!');
    }

}
