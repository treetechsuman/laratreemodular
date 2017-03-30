<?php

namespace Modules\Email\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Email\Entities\EmailTemplate;

class EmailTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $templates = EmailTemplate::all();
        return view('email::email_template_view',compact('templates'));
    }
    public function singleView($id){
        $template = EmailTemplate::findorfail($id)->first();
        return view('email::email_template_single_view',compact('template'));

    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        EmailTemplate::create($request->all());
        return redirect('email/template/view');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        return view('email::email_template_add');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('email::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $template = EmailTemplate::findorfail($id)->first();
        return view('email::email_template_edit',compact('template'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request,$id)
    {
        EmailTemplate::findorfail($id)->update($request->all());
        return redirect('/email/template/view');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function distroy($id)
    {
        EmailTemplate::findorfail($id)->delete();
        return redirect()->back();
    }
}
