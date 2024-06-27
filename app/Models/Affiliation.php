<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affiliation extends Model
{
    use HasFactory;

    protected $table = 'affiliation_sosok';
    protected $primaryKey = 'sid';

    protected $guarded = [
        'sid',
    ];

    public $timestamps = false;

    public function setByData($data)
    {

    }
}
