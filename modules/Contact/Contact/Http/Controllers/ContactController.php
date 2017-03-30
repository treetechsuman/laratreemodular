<?php

namespace Modules\Contact\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
//use Illuminate\Routing\Controller;
use Modules\Contact\Entities\Contact;
use Modules\Contact\Entities\Group;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Modules\Contact\Repositories\ContactRepository;
use Illuminate\Support\Facades\DB;
use Input;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

use Session;


class ContactController extends Controller
{
    private $contactRepo;
    public function __construct(ContactRepository $contactRepo)
    {
        $this->contactRepo = $contactRepo;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $contacts = Contact::paginate(5);

        $groups = Group::all();
        return view('contact::groups_view',compact('contacts','groups'));
    }
    public function contactSingleView($id){
        $contact = Contact::findorfail($id)->first();
        return view('contact::contact_single_view',compact('contact'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('contact::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request,$id)
    {

         $this->validate($request, [
            'phone' => 'required|regex:/(9)[0-9]{9}/',
        ]);


        //return $id;
        $input = $request->all();
        $input['group_id'] = $id;
        $input['user_id'] = Auth::id();
        //return $input;
        Contact::create($input);
        return redirect()->back();

    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $contact = Contact::findorfail($id);
        return view('contact::edit',compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request,$id,$group_id)
    {
         $this->validate($request, [
          'phone' => 'required|max:10',
        ]);

        $input = $request->all();
        print_r($input);
        DB::table('contacts')
            ->where('id', $id)
            ->update([
                'first_name' => $input['first_name'],
                'middle_name' => $input['middle_name'],
                'last_name' => $input['last_name'],
                'first_name' => $input['first_name'],
                'nick_name' => $input['nick_name'],
                'email' => $input['email'],
                'dob' => $input['dob'],
                'phone' => $input['phone'],
                ]);
        return redirect('contact/group/singleView/'.$group_id);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function delete($id)
    {
        Contact::findorfail($id)->delete();
         Session::flash('failed', 'Contact Has Deleted');
        return redirect()->back();
    }


    public function groupEdit($id){
        $group = Group::findorfail($id)->first();
        return view('contact::group_edit',compact('group'));
    }
    public function groupUpdate(Request $request,$id){
        Group::findorfail($id)->update($request->all());
         Session::flash('success', 'Group name updated');
        return redirect('/contact/view');
    }

    public function contactUpload(Request $request,$id)
    {
        $contact = new Contact();
        if(Input::hasFile('contacts')){
            $path = Input::file('contacts')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
            if(!empty($data) && $data->count()){
                //print_r($data->toArray());
                foreach ($data as $key => $value) {
                    $insert[] = ['first_name' => $value->first_name,'middle_name' => $value->middle_name,'last_name' => $value->last_name,'nick_name'=>$value->nick_name,'phone' => $value->phone,'email' => $value->email,'dob' => $value->dob];
                        echo('<pre>');
                        print_r($insert[$key]);
                        echo('</pre>');
                        $contact = $insert[$key];
                        $contact['group_id']=$id;
                        $contact['user_id']=Auth::id();
                        Contact::create($contact);
                }
            }
             Session::flash('success', 'CSV Has Uploaded');


        /*Excel::load(Input::file('contacts'),function($reader){
            //return $reader;
            $reader->each(function($sheet){
                $data = $sheet->toArray();
                //$data['group_id'] = $id;
                Contact::firstOrCreate($sheet->toArray());
            });

        });*/
        return redirect()->back();
        }
    }
    public function contactExport(){
        Excel::create('Filename', function($excel) {
            $excel->sheet('Sheetname', function($sheet) {
            $contacts = Contact::all();
            $sheet->fromModel($contacts);
        });
        })->download('csv');
        return redirect('/contact/view');
    }
    /*Group functions ==========================================================*/
    public function groupAdd(){
        return view('contact::group_add');
    }
    public function groupCreate(Request $request){
        if($this->contactRepo->createGroup($request->all())){
            Session::flash('success', 'Group Has Added');
            return redirect('/contact/view');
        }else{
            Session::flash('failed', 'Group not been added!');
            return redirect()->back();
        }

    }
    public function groupSingleView($id){
        $contacts = Contact::where('group_id',$id)->paginate(10);
        $submenu = Group::where('id',$id)->first();
        return view('contact::index',compact('contacts','id','submenu'));
    }
    public function groupDelete($id){
        if(Group::findorfail($id)->delete()){
        Session::flash('success','Deleted Successfully');

        }else{
            Session::flash('failed','Deletion Unsuccessful');
        }
        return redirect()->back();
    }
    public function groupMergeGet(){
        $groups = Group::all();
        return view('contact::group_merge',compact('groups'));
    }
    public function groupMergePost(Request $request){
        $groups = explode(',',$request['groupId']);
        $newGroup = array();
        $newGroup['name'] = trim($request['newGroup']);
        $contacts = new Contact();
        if($newGroup!=''){
            $createdGroup = $this->contactRepo->createGroup($newGroup);
            //echo $createdGroup['id'];
            foreach ($groups as $group_id) {
                
                if($group_id !=''){
                    //echo $group_id.'<br/>'.$createdGroup['id'];
                 $this->contactRepo->changeGroupOfContacts($group_id,$createdGroup['id']);       
                }
            }
        }else{
            Session::flash('failed','Select Group To Merge or Enter New Group Name!');
            return back();
        }
        Session::flash('success','Groups Successfully Merged to '.$newGroup['name']);
        return back();
        
    }
}
