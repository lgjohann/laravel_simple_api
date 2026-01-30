<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function status()
    {
        return response()->json(
            [
                'status' => 'ok',
                'message' => 'API is running!',
            ], 200
        );
    }

    public function clients()
    {
        $clients = Client::paginate(10);
        return response()->json($clients, 200);
    }
}
