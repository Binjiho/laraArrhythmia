<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;

    public $table = 'surgery_career';

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
//        /**
//         * DB 이전
//         */
//        $this->sid = $data->sid;
//        $this->user_sid = $data->user_sid;

        if($data->surgery_sid) {
            $this->surgery_sid = $data->surgery_sid;
        }
        $this->gubun = $data->gubun ?? 'C';
        $this->sdate = $data->sdate ?? null;
        $this->edate = $data->edate ?? null;
        $this->title = $data->title ?? null;
        $this->content = $data->content ?? null;
        $this->del = $data->del ?? 'N';
        $this->ip = request()->ip();
    }

    public function surgery()
    {
        return $this->belongsTo(Surgery::class, 'surgery_sid')->withTrashed();
    }
}
