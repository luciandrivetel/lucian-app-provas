<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proof extends Model
{
    protected $table = 'proofs';

    protected $primaryKey = 'id';

    protected $fillable = [
        'nome',
        'referencia',
        'comment'
    ];
}
