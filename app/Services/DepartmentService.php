<?php
namespace App\Services;
use App\Department;
use Illuminate\Http\Request;
use App\Transaction;

class DepartmentService
{

    public function destroy(Department $department) : void
    {
        Transaction::where('department_id', $department->id)->update(array('department_id', NULL));
        $department->delete();
        return;
    }

}
