<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class NFe extends Model
{
    protected $tableName = 'nfe';

    protected $columnsNames = [
        'nfe_id',
        'access_key',
        'total_nfe_value'
    ];
}
