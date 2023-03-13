<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use App\Http\Requests\Clients\StoreRequest;

class ClientsController extends Controller
{
    public function new(Request $request)
    {
        $types = [
            ['id' => 'dni', 'name' => 'DNI'],
            ['id' => 'ruc', 'name' => 'RUC'],
            ['id' => 'ce', 'name' => 'CE'],
            ['id' => 'other', 'name' => 'OTRO']
        ];
        return view('modules.clients.new', ['types' => $types]);
    }

    public function store(StoreRequest $request)
    {
       $client = Client::create($request->all());

        Toast::title('Exito!')
            ->center('El cliente se ha guardado con éxito!')
            ->success()
            ->backdrop()
            ->autoDismiss(15);


            return $client;
    }
}
