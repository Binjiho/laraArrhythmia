<?php

namespace App\Models;

use App\Services\CommonServices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Research extends Model
{
    use HasFactory;

    public $table = 'research';

    protected $primaryKey = 'sid';

    protected $guarded = [
        'sid',
        'user_sid',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'certi_date',
    ];

    protected static function booted()
    {
        parent::boot();

        static::deleting(function ($board) {

            // 게시판 데이터 삭제시 첨부파일(단일파일) 있을경우 경로에 있는 실제 파일 삭제
            if (!empty($board->file_path1)) {
                (new CommonServices())->fileDeleteService($board->file_path1);
            }

            if (!empty($board->file_path2)) {
                (new CommonServices())->fileDeleteService($board->file_path2);
            }

            if (!empty($board->file_path3)) {
                (new CommonServices())->fileDeleteService($board->file_path3);
            }

            if (!empty($board->file_path4)) {
                (new CommonServices())->fileDeleteService($board->file_path4);
            }

            if (!empty($board->file_path5)) {
                (new CommonServices())->fileDeleteService($board->file_path5);
            }

        });
    }

    public function setByData($data)
    {
        if(empty($this->sid)) {
            $this->regnum = $data->regnum ?? null;
            $this->name = $data->name;
            $this->runtype = $data->runtype;
            $this->user_sid = thisPk();
            $this->ip = request()->ip();
        }

        /**
         * DB이전
         */
//        $this->sid = $data->research_idx ?? null;
//        $this->research_idx = $data->research_idx ?? null;
//        $this->regnum = $data->regnum ?? null;
//        $this->name = $data->name;
//        $this->runtype = $data->runtype;
//        $this->user_sid = thisPk();
//        $this->ip = request()->ip();
        
        if($data->year) {
            $this->year = $data->year ?? date('Y');
        }
        if($data->category) {
            $this->category = $data->category ?? null;
        }
        if($data->gubun) {
            $this->gubun = $data->gubun ?? null;
        }
        if($data->subject){
            $this->subject = $data->subject;
        }
        if($data->date_type){
            $this->date_type = $data->date_type ?? 'D';
        }
        if($data->sdate){
            $this->sdate = $data->sdate ?? null;
        }
        if($data->edate){
            $this->edate = $data->edate ?? null;
        }
        if($data->tot_price) {
            $this->tot_price = $data->tot_price ?? null;
        }
        if($data->content) {
            $this->content = $data->content ?? null;
        }
        $this->hide = $data->hide ?? 'N';

        /* 첨부파일(단일파일) 업로드 or 삭제 */

        // 파일 업로드 경로
        $directory = "research/";

        for ($i = 1; $i <= 7; $i++) {
//            $this->{'file_name' . $i} = $data->{'file_name' . $i};
//            $this->{'file_path' . $i} = $data->{'file_path' . $i};
            $file = $data->file("file{$i}") ?? null;
            $file_delete = $data->{'file_del'.$i} ?? null;

            // 파일 삭제이면서 기존 첨부파일 있을경우 경로에 있는 실제 파일 삭제
            if ($file_delete && !is_null($this->{'file_path' . $i})) {
                (new CommonServices())->fileDeleteService($this->{'file_path' . $i});

                // 첨부파일이 없다면 기존 파일경로 및 파일명 초기화
                if (is_null($file)) {
                    $this->{'file_path' . $i} = null;
                    $this->{'file_name' . $i} = null;
                }
            }

            // 첨부파일 있을경우 업로드후 경로 저장
            if ($file) {
                $uploadFile = (new CommonServices())->fileUploadService($file, $directory);
                $this->{'file_path' . $i} = $uploadFile['realfile'];
                $this->{'file_name' . $i} = $uploadFile['filename'];
            }
        }
    }

    public function downloadFileUrl($file, $name) // research 첨부 파일 다운로드
    {
        return route('download', ['type' => 'only', 'tbl' => 'research', 'sid' => enCryptString($this->sid) , 'file' => $file, 'name' => $name]);
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_sid')->withTrashed();
    }

    public function research_reviewer()
    {
        return $this->belongsToMany(Reviewer::class, 'research_result', 'research_sid', 'reviewer_sid');
    }

//    public function research_result()
//    {
//        return $this->hasMany(ResearchResult::class, 'research_sid');
//    }

//    public function research_reviewer_usid()
//    {
//        return $this->hasMany(ResearchResult::class, 'research_sid')->pluck('reviewer_sid');
//    }

    public function research_result($research_sid, $reviewer_sid)
    {
        return ResearchResult::where(['research_sid'=>$research_sid, 'reviewer_sid'=>$reviewer_sid ])->first();
    }
}
