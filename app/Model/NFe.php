<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class NFe extends Model
{
    protected $table = 'nfe';

    protected $fillable = [
        'access_key',
        'total_nfe_value',
    ];
}
