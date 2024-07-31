<?php

namespace App\Models;

use App\Services\CommonServices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registration extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'registration';

    protected $primaryKey = 'sid';

    protected $guarded = [
        'sid',
        'csid',
        'user_sid',
    ];
    protected $casts = [
        'position' => 'array',
        'tel' => 'array',
        'phone' => 'array',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'sender_date',
        'send_complete_date',
    ];

    public function setByData($data)
    {
        if(empty($this->sid)) {
            $this->csid = $data->csid;
            $this->event_id = $data->event_id;
            $this->user_sid = thisPk();
            $this->regnum = $data->regnum;
            $this->year = date('Y');
        }
        /**
         * DB이전
         */
//        $this->sid = $data->reg_idx ?? null;
//        $this->reg_idx = $data->reg_idx ?? null;
//        $this->csid = $data->csid ?? null;
//        $this->event_id = $data->event_id ?? null;
//        $this->user_sid = $data->user_sid ?? null;
//        $this->regnum = $data->regnum ?? null;
//        $this->year = date('Y');

        $this->uid = $data->uid;
        $this->first_name = $data->first_name;
        $this->last_name = $data->last_name;
        $this->name_kr = $data->name_kr;

        $this->sosok = $data->sosok;                            //병원 소속
        $this->sosok_kr = $data->sosok_kr;                      //병원 소속(국문)
        $this->sosok_en = $data->sosok_en;
        $this->depart_kr = $data->depart_kr;                    //부서학과명(국문)
        $this->depart_en = $data->depart_en;

        $this->position = $data->position;                      //직책(직함)
        $this->position_etc = $data->position_etc ?? null;

        $this->license_number = $data->license_number ?? null;          //면허번호
        $this->country = $data->country ?? '1';
        $this->phone = $data->phone ?? null;
        $this->tel = $data->tel ?? null;

        $this->birth = $data->birth ?? null;
        $this->gender = $data->gender ?? null;
        $this->job_title = $data->job_title ?? null;
        $this->address = $data->address ?? null;
        $this->training_score = $data->training_score ?? null;

        $this->gubun = $data->gubun ?? null;
        $this->method = $data->method ?? null;
        $this->sender = $data->sender ?? null;
        $this->sender_date = $data->sender_date ?? null;
        
        if( $data->send_complete_date ) {
            $this->send_complete_date = $data->send_complete_date ?? null;
        }
        if( $data->pay_status ) {
            $this->pay_status = $data->pay_status ?? null;
        }
        if( $data->send_status ) {
            $this->send_status = $data->send_status ?? null;
        }
        if( $data->tot_pay ) {
            $this->tot_pay = $data->tot_pay ?? null;
        }

        $this->agree = $data->agree ?? 'N';
        $this->del = $data->del ?? 'N';
    }

    private function conferenceConfig()
    {
        return config('site.conference');
    }

    public function conference()
    {
        return $this->hasOne(Conference::class, 'sid', 'csid');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'sid', 'user_sid')->withTrashed();
    }
}
