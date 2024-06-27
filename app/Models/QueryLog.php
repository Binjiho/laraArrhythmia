<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueryLog extends Model
{
    use HasFactory;

    protected $primaryKey = 'idx';

    protected $guarded = [
        'idx',
    ];

    protected $casts = [
        'query' => 'array',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
