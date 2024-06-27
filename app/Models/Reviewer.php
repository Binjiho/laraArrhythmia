<?php

namespace App\Models;

use App\Services\CommonServices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviewer extends Model
{
    use HasFactory;

    public $table = 'reviewer';

    protected $primaryKey = 'sid';

    protected $guarded = [
        'sid',
        'user_sid',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function setByData($data)
    {
        if (empty($this->sid)) {
            $this->user_sid = $data->user_sid;
            $this->code = $data->code;
        }

        /**
         * DB 이전
         */
//        $this->user_sid = $data->user_sid;
//        $this->reviewer_idx = $data->reviewer_idx;
//        $this->code = 'surgery';

        $this->level = $data->level ?? null;
        $this->use_yn = $data->use_yn ?? null;
        $this->memo = $data->memo ?? null;
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_sid')->withTrashed();
    }

}
