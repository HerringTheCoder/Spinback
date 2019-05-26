<?php

namespace App\Http\Controllers;

use App\Department;
use App\Http\Requests\StoreDepartment;
use App\Http\Requests\UpdateDepartment;

class DepartmentController extends Controller
{
    public function __construct()
    {
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
        $departments = Department::all();
        return view('departments.index', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDepartment $request)
    {
        Department::create($request->validated());
        return redirect()->route('departments.index')->with('success', __('departments.successfully_stored'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDepartment $request, Department $department)
    {
        $department->update($request->validated());
        return redirect()->route('departments.index')->with('success', __('departments.successfully_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('departments.index')->with('success', __('departments.successfully_deleted'));
    }
}
