<?php

namespace Modules\Form\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Form\Repositories\FormRepository;
use Modules\Client\Repositories\ClientRepository;
use Session;
use Modules\Form\Http\Requests\MyFormRequest;

class FormController extends Controller
{
    private $formRepo;
    private $clientRepo;

    //protected $redirectTo = 'auth/home';

    public function __construct(FormRepository $formRepo,ClientRepository $clientRepo)
    {
        $this->formRepo = $formRepo;
        $this->clientRepo = $clientRepo;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $forms = $this->formRepo->getAll();
        return view('form::index',compact('forms'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        session(['menu'=>'create-form']);
        $clients  = $this->clientRepo->getAll();
        return view('form::create',compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(MyFormRequest $request)
    { 
        //return $request->all();

        $form = $this->formRepo->create($request->all());
        if($form['id']){
            session(['from_id' => $form['id']]);
            //Session::('form_id', $form['id']);
            Session::flash('success','Form is added');
             session(['menu'=>'create-field']);
            return redirect('form/create-field/'.$form['id']);
        }
        

        /*Session::flash('error','Form is not added');
        return redirect('form');*/

    }

    
    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $form = $this->formRepo->getById($id);
        return view('form::edit',compact('form'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update($id,MyFormRequest $request)
    { 
        session(['form_id'=>$request->input('form_id')]);
        if($this->formRepo->update($id,$request->all())){
            Session::flash('success','Form is updated');
            return redirect('form');
        }
        Session::flash('error','Form is not updated');
        return redirect('form');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function delete($id)
    {
        if($this->formRepo->delete($id)){
            Session::flash('success','Form is Deleted');
            return redirect('form');
        }
        Session::flash('error','Form is not Deleted');
        return redirect('form');
    }

    public function createField($form_id){
        session(['menu'=>'create-field']);
        session(['form_id'=>$form_id]);
        
        //return session('form_id');
         
       $form = $this->formRepo->getById($form_id);
       //return $form;
       $formFields = $this->formRepo->fieldsByFormId($form_id);
       return view('form::create_fields',compact('form','formFields','fieldCount'));
    }

    public function storeField(Request $request){
        //return $request->all();
        //return $this->formRepo->storeField($request->all());
        if($this->formRepo->storeField($request->all())){
            Session::flash('success','Fields are added');
            session(['menu'=>'create-option']);
            session(['form_id'=>$request->input('form_id')]);
            return redirect('form/create-option');
        }
        Session::flash('error','Unable to add fields');
        return redirect('form/create-option');
    }

    public function deleteField($field_id){
        if($this->formRepo->deleteField($field_id)){
            Session::flash('success','Field is Deleted');
           return back();
        }
        Session::flash('error','Field is not Deleted');
        return back();
    }

    public function editField($form_id){
        $form = $this->formRepo->getById($form_id);
        $formFields = $this->formRepo->fieldsByFormId($form_id);
        return view('form::updatefields',compact('form','formFields'));
    }

    public function updateField(Request $request,$form_id){
        //return $request->all();
        session(['form_id'=>$form_id]);
        if($this->formRepo->updateField($request->all())){
            Session::flash('success','Fields are Updated');
            return back();
        }
        Session::flash('error','Unable to Updated fields');
        return back();
    }

    public function formPreview($form_id){
        $form = $this->formRepo->getById($form_id);
        $formFields = $this->formRepo->fieldsByFormId($form_id);
        $formRepo = $this->formRepo;
        return view('form::previewform',compact('form','formFields','formRepo'));
        
    }

    public function createOption(){
        $fields = $this->formRepo->fieldsByFormId(session('form_id'));
        //return $fields;
        $formRepo = $this->formRepo;
        return view('form::create_option',compact('fields','formRepo'));
    }

    public function storeOption(Request $request){
        //return $this->formRepo->storeOption($request->all());
        if($this->formRepo->storeOption($request->all())){
            Session::flash('success','Opetion are created');
            return redirect('form');
        }
         Session::flash('error','Opetion are Not created');
            return back();
    }

    public function deleteOption($option_id){
        if($this->formRepo->deleteOption($option_id)){
            Session::flash('success','Opetion is deleted');
            return back();
        }
        Session::flash('error','Option is not deleted');
        return back();
    }

    public function editOption($option_id){
        $option = $this->formRepo->getOptionById($option_id);
        //return $option;
        return view('form::update_option',compact('option'));
    }

    public function updateOption($option_id,Request $request){
        if($this->formRepo->updateOption($option_id,$request->all())){
           Session::flash('success','Opetion is Updated');
            return back(); 
        }
        Session::flash('error','Option is not Updated');
        return back();
    }

    public function updateFieldOption($field_id){
        //echo "this is update field option";
        $field = $this->formRepo->getFieldById($field_id);
        $formRepo = $this->formRepo;
        return view('form::update_field_option',compact('field','formRepo'));
    }

   

}

