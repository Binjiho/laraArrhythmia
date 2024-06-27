<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table = 'country';
    protected $primaryKey = 'ci';

    protected $guarded = [
        'ci',
    ];

    public $timestamps = false;

    public function setByData($data)
    {

    }
    public function conference()
    {
        return $this->belongsTo(Conference::class, 'ccode')->withTrashed();
    }
}
