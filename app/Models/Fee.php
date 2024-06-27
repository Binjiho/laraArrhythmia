<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Fee extends Model
{
    use HasFactory;

    public $table = 'fee';
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
            $this->user_sid = $data->user_sid;
            $this->fee_idx = $data->fee_idx;
        }

        /**
         * DB이전
         */
//        $this->sid = $data->fee_idx;
//        $this->fee_idx = $data->fee_idx;
//        $this->user_sid = $data->user_sid;
//        $this->uid = $data->uid;

        $this->year = $data->year ?? date('Y');
        $this->category = $data->category ?? null;
        $this->detail = $data->detail ?? 'A';
        $this->detail_etc = $data->detail_etc ?? null;
        $this->price = unComma($data->price);
        $this->depositor = $data->depositor ?? null;
        $this->deposit_date = $data->deposit_date ?? null;
        $this->pay_status = $data->pay_status;
        $this->pay_date = $data->pay_date ?? null;
        $this->method = $data->method ?? 'B';
        $this->memo = $data->memo ?? null;
        $this->ip = request()->ip();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_sid')->withTrashed();
    }

    public function payStatus()
    {
        $sDate = date('Y');
        $eDate = date('Y')+1;

        $txt = "미납";
        if ($this->pay_date >= $sDate.'-01-01' && $this->pay_date < $eDate.'-12-31') {
            $txt = "납부";
        }

        return $txt;
    }
}
