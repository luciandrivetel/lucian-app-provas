<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proof extends Model
{
    protected $table = 'proofs';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'nome',
        'referencia',
        'data',
        'comment'
    ];

    protected $casts = [
        'data' => 'date'
    ];
}
