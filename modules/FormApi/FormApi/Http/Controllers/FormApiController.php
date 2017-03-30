<?php

namespace Modules\FormApi\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Hash;
use JWTAuth;

use Modules\Form\Repositories\FormRepository;

class FormApiController extends Controller
{
    private $formRepo;
    //protected $redirectTo = 'auth/home';

    public function __construct(FormRepository $formRepo)
    {
        $this->formRepo = $formRepo;
        //$this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index($form_id,Request $request)
    {
        //return $request->header('client_id');
        //$form = $this->formRepo->getById($form_id);
        if($request->header('clientid')){
            $form = $this->formRepo->getFormByIdAndClientId($form_id,$request->header('clientid'));
        }
        if($request->header('eventid')){
            $form = $this->formRepo->getFormByIdAndEventId($form_id,$request->header('eventid'));
        }
        //return $form;

        //check this client or event have form or not-------------------
        if(!$form){
            $response = [
            'error' => 'this client doesnot have form'
            ];
            return response()->json($response,404);
        }
        //get all fields of this form-----------------
        $formFields = $this->formRepo->fieldsByFormId($form_id);
        
        $response = [
            'form_details'=>$this->prepareForm($form),
            'fields' => $this->prepareField($formFields)
        ];
        return response()->json($response,200);
    }

    public function formsByClientId(Request $request){
        //all form of client-------------
        $forms = $this->formRepo->formsByClientId($request->header('clientid'));
        if(!$forms){
            $response = [
            'error' => 'this client doesnot have total form'
            ];
            return response()->json($response,404);
        }
        $response = [
            'forms' => $forms
        ];
        return response()->json($response,200);
    }

    public function formsByEventId(Request $request){
        //all form of event-------------
        $forms = $this->formRepo->formsByEventId($request->header('eventid'));
        if(!$forms){
            $response = [
            'error' => 'this Event doesnot have total form'
            ];
            return response()->json($response,404);
        }
        $response = [
            'forms' => $forms
        ];
        return response()->json($response,200);
    }

    public function formSubmit(Request $request){
        //return $request->all();
        //dd($request->all());
        /*echo '<pre>';
        print_r($request->all());
        echo '</pre>';*/

        if($this->formRepo->formSubmit($request->all())){
           $response = [
            'message' => 'form is submited'
            ];
            return response()->json($response,201); 
        }
    }

    //this function is to prepare form fields in required formate-------------
    private function prepareField( $fields){
        $result = array();
        foreach($fields as $field){
            $temp = array();
            $temp['name']=$field['name'];
            $temp['key']=$field['name_key'];
            $temp['type']=$field['type'];
            $temp['validation']=$field['validation'];
            $temp['element_type']=$field['element_type'];
            if($field['type']=='radio'||$field['type']=='checkbox'){
                $temp['options'] = $this->prepareOption($this->formRepo->getOptionByFieldId($field['id']));
            }
            if($field['element_type']=='select'){
                $temp['type']=$field['element_type'];
                $temp['options'] = $this->prepareOption($this->formRepo->getOptionByFieldId($field['id']));
            }
            array_push($result, $temp);
        }
        return $result;
    }
    //this function is to prepare forms in required formate-------------
    private function prepareForm($forms){
        $result = array();
        //foreach($forms as $forms){
            $temp = array();
            $temp['id']=$forms['id'];
            $temp['title']=$forms['title'];
            $temp['submit_url']=$forms['submit_url'];
            $temp['version']=$forms['version'];
            array_push($result, $temp);
        //}
        return $result;
    }
    //this function is to prepare fields option in required formate-------------
    private function prepareOption($options){
        $result = array();
        foreach($options as $option){
            $temp = array();
            $temp['id']=$option['id'];
            $temp['name']=$option['name'];
            $temp['value']=$option['value'];
            array_push($result, $temp);
        }
        return $result;
    }

}
