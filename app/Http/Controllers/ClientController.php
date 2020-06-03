<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $companyRuc = $request->input('companyRuc');

        if ($companyRuc) {
            return Client::where('companyRuc', '=', $companyRuc)->get();
        }
        return Client::all();
    }
 
    public function show($id)
    {
        return Client::find($id);
    }

    public function store(Request $request)
    {
        return Client::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);
        $client->update($request->all());

        return $client;
    }

    public function delete(Request $request, $id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return 204;
    }
}
