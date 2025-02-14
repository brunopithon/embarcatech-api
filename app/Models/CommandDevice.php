<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CommandDevice extends Pivot {

    protected $fillable = [
        'device_id',
        'command_id',
    ];
}
