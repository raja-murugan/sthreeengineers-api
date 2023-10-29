<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    public function index()
    {
        $client = Client::where('soft_delete', '!=', 1)->get();

        return response()->json($client);
    }

    public function store(Request $request)
    {
        $randomkey = Str::random(5);

        $client = new Client();

        $client->unique_key = $randomkey;
        $client->name = $request->get('name');
        $client->phone_number = $request->get('phone_number');
        $client->alternate_phone_number = $request->get('alternate_phone_number');
        $client->email_id = $request->get('email_id');
        $client->address = $request->get('address');

        $client->save();

        return response()->json($client);
    }

    public function show($id)
    {
        $client = Client::where('soft_delete', '!=', 1)->find($id);

        return response()->json($client);
    }

    public function update(Request $request, Client $id)
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

    public function destroy(Request $request, Client $id)
    {
        $id->soft_delete = 1;
        $id->save;

        return response()->json($id, 200);
    }
}
