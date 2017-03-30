<?php

namespace Modules\App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\App\Repositories\AppRepository;
use Modules\Permission\Repositories\PermissionRepository;
use Session;

class AppController extends Controller
{
    private $appRepo;
    private $permissionRepo;
    /**
     * Display a listing of the resource.
     * @return Response
     */

    public function __construct(AppRepository $appRepo,PermissionRepository $permissionRepo)
    {
        $this->appRepo = $appRepo;
        $this->permissionRepo = $permissionRepo;
    }

    public function index()
    {
        $apps = $this->appRepo->getAll();
        return view('app::app_view',compact('apps'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('app::app_add');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->appRepo->create($request->all());
        Session::flash('success','App is added');
        return redirect('app');

    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('app::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $app = $this->appRepo->getById($id);
        return view('app::app_edit',compact('app'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request,$id)
    {
        if($this->appRepo->update($id,$request->all())){
            Session::flash('success','App is updated');
            return redirect('app');
        }
        Session::flash('error','App is not updated');
        return redirect('app');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        if($this->appRepo->delete($id)){
            Session::flash('success','App is Deleted');
            return redirect('app');
        }
        Session::flash('error','App is not Deleted');
        return redirect('app');
    }

    public function permission($id){
        $app = $this->appRepo->getById($id);
        $permissions = $this->appRepo->getNotGrantedPermissions($id);
        $grantedPermissions = $this->appRepo->getPermissionByAppId($id);

        //return $permissions;
        return view('app::permission_view',compact('app','permissions','grantedPermissions'));  
    }

    public function givePermission($id,Request $request){
        //return $request->all();
        if($this->appRepo->givePermission($id,$request->all())){
             Session::flash('success','Permission is Granted');
        }else{
             Session::flash('error','Permission is not Denied');
        }
        //return $temp;
        return redirect()->back();
    }

    public function removePermission($id,Request $request){
        //return $request->all();
        if($this->appRepo->removePermission($id,$request->all())){
             Session::flash('success','Permission is Removed');
        }else{
             Session::flash('error','Permission is not Removed');
        }
        return redirect()->back();
    }

    
}
