<?php

namespace Modules\Client\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Client\Repositories\ClientRepository;
use Session;
class ClientController extends Controller
{
    private $clientRepo;

    //protected $redirectTo = 'auth/home';

    public function __construct(ClientRepository $clientRepo)
    {
        $this->clientRepo = $clientRepo;
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $clients =  $this->clientRepo->getAll();
        return view('client::index',compact('clients'));
    }

    public function create()
    {
        return view('client::create');
    }

    public function store(Request $request)
    {
        if($this->clientRepo->create($request->all())){
            Session::flash('success','client is created');
            return redirect('client');
        }
        Session::flash('error','client is not created');
        return redirect('client');
    }

    public function edit($id)
    {
        $client = $this->clientRepo->getById($id);
        return view('client::edit',compact('client'));
    }

    public function update($id,Request $request){
        if($this->clientRepo->update($id,$request->all())){
            Session::flash('success','client is Updated');
            return redirect('client');
        }
        Session::flash('error','client is not Updated');
        return redirect('client');
    }

    public function delete($id){
        if($this->clientRepo->delete($id)){
            Session::flash('success','client is Deleted');
            return redirect('client');
        }
        Session::flash('error','client is not Deleted');
        return redirect('client');
    }

    public function permission($id){
        $client = $this->clientRepo->getById($id);
        $permissions = $this->clientRepo->getNotGrantedPermissions($id);
        $grantedPermissions = $this->clientRepo->getPermissionByClientId($id);

        //return $permissions;
        return view('client::permission_view',compact('client','permissions','grantedPermissions'));  
    }

    public function givePermission($id,Request $request){
        //return $request->all();
        if($this->clientRepo->givePermission($id,$request->all())){
             Session::flash('success','Permission is Granted');
        }else{
             Session::flash('error','Permission is not Denied');
        }
        //return $temp;
        return redirect()->back();
    }

    public function removePermission($id,Request $request){
        //return $request->all();
        if($this->clientRepo->removePermission($id,$request->all())){
             Session::flash('success','Permission is Removed');
        }else{
             Session::flash('error','Permission is not Removed');
        }
        return redirect()->back();
    }

    
}
