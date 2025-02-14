<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateDeviceRequest;

class DeviceController extends Controller {
    /**
     * Exibe todos os dispositivos.
     */
    public function index() {
        return response()->json(Device::all(), 200);
    }

    /**
     * Cria um novo dispositivo.
     */
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'is_on' => 'boolean',
        ]);

        $device = Device::create($request->all());

        return response()->json($device, 201);
    }

    /**
     * Exibe um dispositivo específico.
     */
    public function show($id) {
        $device = Device::find($id);

        if (!$device) {
            return response()->json(['message' => 'Dispositivo não encontrado'], 404);
        }

        return response()->json($device, 200);
    }

    /**
     * Atualiza um dispositivo existente.
     */
    public function update(UpdateDeviceRequest $request, $id) {
        $device = Device::find($id);

        if (!$device) {
            return response()->json(['message' => 'Dispositivo não encontrado'], 404);
        }

        // O Laravel automaticamente valida os dados da requisição com o UpdateDeviceRequest
        $device->update($request->validated()); // Use validated() para pegar os dados validados
        $device->save();

        return response()->json($device, 200);
    }

    /**
     * Remove um dispositivo.
     */
    public function destroy($id) {
        $device = Device::find($id);

        if (!$device) {
            return response()->json(['message' => 'Dispositivo não encontrado'], 404);
        }

        $device->delete();

        return response()->json(['message' => 'Dispositivo excluído com sucesso'], 200);
    }
}
