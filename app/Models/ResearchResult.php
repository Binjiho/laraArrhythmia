<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResearchResult extends Model
{
    public $table = 'research_result';

    protected $primaryKey = 'sid';
    protected $fillable = [
        'sid',
        'research_sid',
        'reviewer_sid',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
    
    public function setByData($data)
    {
        if(empty($this->sid)) {
            $this->result_idx = $data->result_idx;
            $this->research_sid = $data->research_sid;
            $this->reviewer_sid = $data->reviewer_sid;
            $this->ip = request()->ip();
        }
        /**
         * DB이전
         */
//        $this->sid = $data->result_idx;
//        $this->result_idx = $data->result_idx;
//        $this->research_sid = $data->research_sid;
//        $this->reviewer_sid = $data->reviewer_sid;

        if($data->score1){
            $this->score1 = $data->score1 ?? 0;
        }
        if($data->score2){
            $this->score2 = $data->score2 ?? 0;
        }
        if($data->score3){
            $this->score3 = $data->score3 ?? 0;
        }
        if($data->score4){
            $this->score4 = $data->score4 ?? 0;
        }
        if($data->score5){
            $this->score5 = $data->score5 ?? 0;
        }
        if($data->tot_score){
            $this->tot_score = $data->tot_score ?? 0;
        }
        if($data->tot_avg){
            $this->tot_avg = $data->tot_avg ?? 0;
        }

        $this->state = $data->state ?? 'N';

        if($data->memo){
            $this->memo = $data->memo ?? NULL;
        }
    }

    public function research()
    {
        return $this->belongsTo(Research::class, 'research_sid');
    }

    public function reviewer_info($reviewer_sid)
    {
        return User::where(['sid'=>$reviewer_sid ])->first();
    }
}
