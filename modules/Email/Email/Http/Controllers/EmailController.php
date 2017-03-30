<?php

namespace Modules\Email\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Contact\Entities\Contact;
use Modules\Contact\Entities\Group;
use Modules\Email\Entities\EmailTemplate;
//use Illuminate\Mail\Mailer;
use Modules\email\Emails\MyMail;
use Input;
use  Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Mail;

class emailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $contacts = Contact::all();
        $groups = Group::all();
        $templates = EmailTemplate::all();

        return view('email::index',compact('contacts','groups','templates'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('email::create');
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
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('email::edit');
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
    public function sendMail(Request $request){
        //return $request['template'];
        $template = EmailTemplate::findorfail($request['template']);
        //$subject = $template['subject'];

        $message = $template['message'];
        
        //return $message;
        $arr = explode(',', $request['to']);
        foreach ($arr as $contact1) {
            if($contact1!=''){
                echo $contact1;
                echo "<br>";

                
                $message = str_replace("{user}", $contact1, $message);
                $message = str_replace("{activation_link}", 'activation_link', $message);
                $message = str_replace("{closing_greetings_footer}",'Best Regards, Socialaves !' ,$message);
                Mail::to($contact1)->send(new MyMail($message,$template['subject']));
            }
        }
        
        return redirect()->back();
    }

    public function csvUpload(Request $request){


            if(Input::hasFile('contacts')){
            $path = Input::file('contacts')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
            if(!empty($data) && $data->count()){
                //print_r($data->toArray());
                foreach ($data as $key => $value) {
                    $insert[] = ['email' => $value->email,'name' => $value->name];

                }
            }
        }
        $contacts = Contact::paginate(6);
        return view('email::index',compact('insert','contacts'));
    }
}
