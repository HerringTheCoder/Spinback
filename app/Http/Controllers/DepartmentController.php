<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;
use App\Services\DepartmentService;

class DepartmentController extends Controller
{
    public function __construct(DepartmentService $department)
    {
        $this->department = $department;
        $this->authorizeResource(Department::class);
        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments=$this->department->index();
        $message=session('message');
        return view('test.departments.panel')->with('departments', $departments)->with('message', $message);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //TODO
        //return department creation form view
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->department->validateStore($request);
        $this->department->store($request);
        return redirect()->action('DepartmentController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //TODO
        //return view with single Department details
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //TODO
        //Return view with Department edit form
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $this->department->validateUpdate($request);
        $this->department->update($department, $request);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $this->department->destroy($department);
        return redirect()->action('DepartmentController@index');
    }
}
