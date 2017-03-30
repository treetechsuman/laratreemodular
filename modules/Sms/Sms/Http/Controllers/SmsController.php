<?php

namespace Modules\Sms\Http\Controllers;

use Redirect;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Contact\Entities\Contact;
use Modules\Contact\Entities\Group;
//use Illuminate\Mail\Mailer;
use Modules\sms\Entities\SMS;
use Auth;
use Modules\email\Emails\MyMail;
use Input;
use Session;
use  Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use DB;
use Nexmo;


class SmsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $contacts = Contact::all();
        $groups = Group::all();

        return view('sms::index',compact('contacts','groups'));

    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('sms::create');
    }
    public function addsmstodb($number, $message){
        $input = array();
        $input['number'] = $number;
        $input['message'] = $message;
        $input['user_id'] = Auth::user()->id;
        
        DB::table('sms')->insert(
            [
                'number' => $number, 
                'message' => $message,
                'user_id' => Auth::user()->id
            ]
        );

       return true;
    }
    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('sms::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('sms::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
    public function sendSms(Request $request){
    //   $this->validate($request, [
    //      'phone' => 'required|numeric|max:10|min:8',
    //  ]);
        $client = new Client();

      $contacts = $request->all();
      $contact = explode(',',$contacts['to']);
      $message = $contacts['message'];
      $message = urlencode($message);

      $numbers = '';
      $i =0;
      $rejectedNumber = '';
      // finding correct numbers
      foreach ($contact as $to) {
        if(strlen(trim($to))==10){
            $this->addsmstodb($to,$message);
            $numbers = $numbers.$to.',';
            $i++;
            if($i == 10){
              $response = $client->post('http://192.168.1.17:5444/sms?to='.$numbers.'&message='.$message);
              //$response = file_get_contents('http://192.168.1.17:5444/sms?to='.$numbers.'&message='.$message);
              $i = 0;
              $numbers = '';
            }
        }else{
          $rejectedNumber .= $to .', ';
        }
      }
      $response = $client->post('http://192.168.1.17:5444/sms?to='.$numbers.'&message='.$message);
      //$response = file_get_contents('http://192.168.1.17:5444/sms?to='.$numbers.'&message='.$message);
      // creating chunk of number

      Session::flash('success','Message Sent');
      return back();
        // Nexmo::message()->send([
        //     'to' => '9779843408895',
        //     'from' => '9779849949205',
        //     'text' => 'Social aves Sms testing'
        // ]);

    }

}