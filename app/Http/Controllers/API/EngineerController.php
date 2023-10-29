<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Engineer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EngineerController extends Controller
{
    public function index()
    {
        $engineer = Engineer::all();

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

    public function view($id)
    {
        $engineer = Engineer::find($id);

        return response()->json($engineer);
    }

    public function update($id)
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

    public function destroy($id)
    {
        $data = request()->validate(
            [
                'soft_delete' => 1,
            ]
        );

        $id->update($data);

        return response()->json($id, 200);
    }
}
