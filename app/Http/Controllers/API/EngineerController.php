<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Engineer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EngineerController extends BaseController
{
    public function index()
    {
        $engineer = Engineer::where('soft_delete', '!=', 1)->get();

        return response()->json($engineer);
    }

    public function store(Request $request)
    {
        $randomkey = Str::random(5);

        $engineer = new Engineer();

        $engineer->unique_key = $randomkey;
        $engineer->name = $request->get('name');
        $engineer->phone_number = $request->get('phone_number');
        $engineer->alternate_phone_number = $request->get('alternate_phone_number');
        $engineer->email_id = $request->get('email_id');
        $engineer->address = $request->get('address');

        $engineer->save();

        return response()->json($engineer);
    }

    public function show($id)
    {
        $engineer = Engineer::where('soft_delete', '!=', 1)->find($id);

        return response()->json($engineer);
    }

    public function update(Request $request, Engineer $id)
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

    public function destroy(Request $request, Engineer $id)
    {
        $id->soft_delete = 1;
        $id->save;

        return response()->json($id, 200);
    }
}
