<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommandRequest extends FormRequest {
    /**
     * Determina se o usuário está autorizado a fazer esta solicitação.
     *
     * @return bool
     */
    public function authorize() {
        return true; // Altere isso conforme sua lógica de autorização, se necessário
    }

    /**
     * Obtenha as regras de validação para a solicitação.
     *
     * @return array
     */
    public function rules() {
        return [
            'name' => 'required|string|max:255',
            // Valida que device_id é um array de ids válidos
            'device' => 'nullable|array',
            'device.*.device_id' => 'exists:devices,id', // Valida cada id dentro do array
        ];
    }
}
