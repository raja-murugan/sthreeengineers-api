<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EmployeeController extends BaseController
{
    public function index()
    {
        $employee = Employee::where('soft_delete', '!=', 1)->get();

        return response()->json($employee);
    }

    public function store(Request $request)
    {
        $randomkey = Str::random(5);

        $employee = new Employee();

        $employee->unique_key = $randomkey;
        $employee->name = $request->get('name');
        $employee->phone_number = $request->get('phone_number');
        $employee->alternate_phone_number = $request->get('alternate_phone_number');
        $employee->email_id = $request->get('email_id');
        $employee->address = $request->get('address');

        $employee->save();

        return response()->json($employee);
    }

    public function show($id)
    {
        $employee = Employee::where('soft_delete', '!=', 1)->find($id);

        return response()->json($employee);
    }

    public function update(Request $request, Employee $id)
    {
        $data = request()->validate(
            [
                'name' => '',
                'phone_number' => '',
                'alternate_phone_number' => '',
                'email_id' => '',
                'address' => '',
            ]
        );

        $id->update($data);

        return response()->json($id, 200);
    }

    public function destroy(Request $request, Employee $id)
    {
        $id->soft_delete = 1;
        $id->save;

        return response()->json($id, 200);
    }
}
