<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Command extends Model {
    protected $fillable = [
        'name',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    // Adiciona 'devices' ao array $appends para que ele seja automaticamente incluído quando o model for convertido para array ou JSON
    protected $appends = ['devices'];

    // Define o relacionamento 'many-to-many' com a tabela de devices
    public function devices() {
        return $this->belongsToMany(Device::class, 'command_device');
    }

    // Método para adicionar os devices ao resultado
    public function getDevicesAttribute() {
        // Retorna os devices relacionados ao comando e oculta a tabela pivot
        return $this->devices()->get()->makeHidden(['pivot']);
    }
}
