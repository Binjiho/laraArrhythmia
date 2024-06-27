<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurgeryResult extends Model
{
    public $table = 'surgery_result';

    protected $primaryKey = 'sid';
    protected $fillable = [
        'sid',
        'surgery_sid',
        'reviewer_sid',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function setByData($data)
    {
        if(empty($this->sid)) {
            $this->surgery_sid = $data->surgery_sid;
            $this->reviewer_sid = $data->reviewer_sid;
            $this->ip = request()->ip();
        }
        /**
         * DB 이전
         */
//        $this->sid = $data->sid;
//        $this->reviewer_sid = $data->reviewer_sid;
//        $this->user_sid = $data->user_sid;

        if($data->state){
            $this->state = $data->state ?? 'N';
        }
        if($data->certi){
            $this->certi = $data->certi ?? 'N';
        }
        if($data->memo){
            $this->memo = $data->memo ?? NULL;
        }
    }

    public function surgery()
    {
        return $this->belongsTo(Surgery::class, 'surgery_sid');
    }

    public function reviewer_info($reviewer_sid)
    {
        return User::where(['sid'=>$reviewer_sid ])->first();
    }
}
