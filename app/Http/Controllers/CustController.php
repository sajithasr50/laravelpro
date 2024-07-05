<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Jobs\SendEmailJob;



class CustController extends Controller

{

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function __construct()

    {

        $this->middleware('auth');
    }



    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Contracts\Support\Renderable

     */

    // public function index()

    // {


    //     $details['email'] = 'rksinghniit@gmail.com';

    //     dispatch(new SendEmailJob($details));

    //     return response()->json(['status'=> 200, 'Message' =>"Message has been send"]);

    // }

    public static function mailSent($email)

    {

        $details['email'] = $email;

        dispatch(new SendEmailJob($details));

        return response()->json(['status' => 200, 'Message' => "Message has been send"]);
    }
}
