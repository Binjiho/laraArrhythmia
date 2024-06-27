<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    use HasFactory;

    protected $primaryKey = 'sid';

    protected $guarded = [
        'sid',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
    

    public function setByData($data)
    {
        if (empty($this->sid)) {
            $this->g_sid = $data['g_sid'];
//        $this->user_sid = $data->user_sid ?? null;
        }

//        $this->g_sid = $data->g_sid;
//        $this->user_sid = $data->user_sid ?? null;

        $this->position = $data['position'] ?? null;
        $this->uid = $data['uid'] ?? null;
        $this->name_kr = $data['name_kr'] ?? null;
        $this->sosok = $data['sosok'] ?? null;
    }

    public function group()
    {
        return $this->belongsTo(GroupMember::class, 'g_sid');
    }
}
