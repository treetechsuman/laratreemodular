<?php

namespace Modules\Form\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Form\Repositories\FormRepository;
use Session;
use Modules\Form\Http\Requests\MyFormRequest;

class FormSubmissionController extends Controller
{
    private $formRepo;

    //protected $redirectTo = 'auth/home';

    public function __construct(FormRepository $formRepo)
    {
        $this->formRepo = $formRepo;
        $this->middleware('auth');
    }

    public function formSubmit(Request $request){
        //return "come here";
        //dd($request->all());
        /*echo '<pre>';
        print_r($request->all());
        echo '</pre>';*/

        if($this->formRepo->formSubmit($request->all())){
            Session::flash('success','Form is Submited');
            return redirect('form');
        }
    }

    public function submittedFormValue($form_id){
        $form = $this->formRepo->getById($form_id);
       //return $form;
       $formFields = $this->formRepo->fieldsByFormId($form_id);

       $formSubmissions = $this->formRepo->getFormSumissionByFormId($form_id);
       $formRepo = $this->formRepo;
       return view('form::submitted_form_value',compact('form','formFields','formSubmissions','formRepo'));
    }

}

