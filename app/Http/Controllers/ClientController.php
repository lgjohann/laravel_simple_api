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

    public function clientById(string $id, Request $request)
    {
        try {
            $client = Client::findOrFail($id);
            return response()->json($client, 200);
        } catch (\Throwable $exception) {
            return response()->json([
                'path'=> $request->getRequestUri(),
                'method' => $request->getMethod(),
                'status' => 404,
                'message' => "Couldn't find the client with id {$id}",
            ], 404);
        }

    }

    public function createClient(Request $request)
    {
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:clients',
            ]);

            $client = Client::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
            ]);

            return response()->json($client, 201);
    }

    public function updateClient(string $id, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        try {

            $client = Client::findOrFail($id);
            $client->name = $validatedData['name'];
            $client->email = $validatedData['email'];
            $client->save();

            return response()->json($client, 200);
        } catch (\Throwable $exception) {
            return response()->json([
                'path'=> $request->getRequestUri(),
                'method' => $request->getMethod(),
                'status' => 404,
                'message' => "Couldn't find the client with id {$id}",
            ], 404);
        }
    }

    public function deleteClient(string $id, Request $request)
    {
        try {
            $client = Client::findOrFail($id);
            $client->delete();
            return response()->json($client, 200);
        } catch (\Throwable $exception) {
            return response()->json([
                'path'=> $request->getRequestUri(),
                'method' => $request->getMethod(),
                'status' => 404,
                'message' => "Couldn't find the client with id {$id}",
            ], 404);
        }

    }
}
