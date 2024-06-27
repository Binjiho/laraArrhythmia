<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurgeryCase extends Model
{
    use HasFactory;

    public $table = 'surgery_case';

    protected $primaryKey = 'sid';

    protected $guarded = [
        'sid',
        'surgery_sid',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function setByData($data)
    {
        if (thisAuth()->check()) {
            $this->user_sid = thisPk();
        }
        /**
        * DB 이전
        */
//        $this->sid = $data->sid;
//        $this->user_sid = $data->user_sid;

        if($data->surgery_sid){
            $this->surgery_sid = $data->surgery_sid;
        }
        $this->gubun = $data->gubun ?? 'A';
        $this->name = $data->name ?? null;
        $this->age = $data->age ?? null;
        $this->gender = $data->gender ?? null;
        $this->num = $data->num ?? null;
        $this->title = $data->title ?? null;
        $this->date = $data->date ?? null;
        $this->content = $data->content ?? null;
        $this->del = $data->del ?? 'N';
        $this->ip = request()->ip();
    }
}
