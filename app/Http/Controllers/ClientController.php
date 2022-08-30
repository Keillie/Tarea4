<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Client;

class ClientController extends Controller
{
    /** 
     * Display a listing of the resource.
     **/
    public function index()
    {
        $clients = Client::all();
        return response()->json($clients);
    }

    /** 
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'last_name' => 'required',
            'dpi' => 'required',
            'customer_email' => 'required|email'
        ];
        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'max' => 'El texto en el campo no es un :attribute no es un correo'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json([
                'message' => "Información incompleta o inválida -> ".$validator->messages()->first()
            ], 400);
        }
        $clients = Client::create($request->all());
        return response()->json([
            'message' => "Clients saved successfully!",
            'clients' => $clients
        ], 200);
    }

    public function show($id)
    {
        $clients = Client::find($id);
        return response()->json(
            //['message'=>"Datos obtenidos correctamente",'clients'=>$clients]
            $clients,200);
    }

    /** 
     * Udptate (editar) clients.
    **/
    public function update(Request $request, Client $client)
    {
        $client->update($request->all());

        return response()->json([
            'message' => "Client updated successfully!",
            'client' => $client
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return response()->json([
            'message' => "Client deleted successfully!",
        ], 200);
    }
}
