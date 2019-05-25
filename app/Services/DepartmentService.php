<?php
namespace App\Services;
use App\Department;
use Illuminate\Http\Request;
use Bouncer;

class DepartmentService
{

    public function index()
    {
        $department = Department::All();
        return $department;
    }


    public function store(Request $request) :void
    {
        $department=new Department();
        $department->name = $request->input('name');
        $department->address = $request->input('address');
        $department->city= $request->input('city');
        $department->phone_number= $request->input('phone_number');
        $department->save();
        session()->flash('message', 'Department added successfully');
        return;
    }

    public function update(Department $department, Request $request) : void
    {
        $department->name= $request->input('name');
        $department->country = $request->input('address');
        $department->description = $request->input('phone_number');
        $department->save();
        return;
    }


    public function destroy(Department $department) : void
    {

        $department->delete();
        session()->flash('message','Department deleted successfully');
        return;
    }

    public function validateUpdate(Request $request)
    {
        $request->validate([
            'name' => 'min:3|max:20',
            'city' => 'min:3|max:20|alphanumeric',
        ]);
    }

    public function validateStore(Request $request)
    {
        $request->validate([
            'name' => 'min:3|max:20',
            'phone_number'=> 'digits_between:10,12',
            'address'=> 'min:5|max:40|alphanumeric',
            'phone_number'=> 'digits_between:10,12'
        ]);
    }

}
