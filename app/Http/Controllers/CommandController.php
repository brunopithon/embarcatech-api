<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Command;
use App\Http\Requests\StoreCommandRequest;

class CommandController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return response()->json(Command::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommandRequest $request) {
        // Validando os dados
        $data = $request->validated();

        // Criando o comando
        $command = Command::create($data);

        // Verificando se 'device_id' foi fornecido e associando ao comando
        if (!empty($data['device'])) {
            // Extraindo apenas os device_id do array
            $deviceIds = collect($data['device'])->pluck('device_id')->toArray();

            // Associando os dispositivos ao comando
            $command->devices()->attach($deviceIds);
        }

        // Retornando a resposta com o comando criado
        return response()->json($command, 201);
    }


    /**
     * Display the specified resource.
     */
    public function show($id) {
        $command = Command::find($id);

        if (!$command) {
            return response()->json(['message' => 'Command not found'], 404);
        }

        return response()->json($command);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {
        $command = Command::find($id);

        if (!$command) {
            return response()->json(['message' => 'Command not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $command->update($validated);

        return response()->json($command);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $command = Command::find($id);

        if (!$command) {
            return response()->json(['message' => 'Command not found'], 404);
        }

        $command->delete();

        return response()->json(['message' => 'Command deleted successfully']);
    }
}
