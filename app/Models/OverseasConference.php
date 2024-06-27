<?php

namespace App\Models;

use App\Services\CommonServices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OverseasConference extends Model
{
    use HasFactory;

    public $table = 'overseas_conference';

    protected $primaryKey = 'sid';

    protected $guarded = [
        'sid',
        'user_sid',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected static function booted()
    {
        parent::boot();

        static::deleting(function ($conference) {

            // 데이터 삭제시 첨부파일(단일파일) 있을경우 경로에 있는 실제 파일 삭제
            if (!empty($conference->file_path)) {
                (new CommonServices())->fileDeleteService($conference->file_path);
            }

            // 첨부파일 (plupload) 있을경우 하나씩 삭제
            $conference->files()->each(function ($file) {
                $file->delete();
            });
        });
    }

    public function setByData($data)
    {
//        if(empty($this->sid)) {
//            $this->user_sid = thisPk();
//        }

        /**
         * DB이전
         */
//        $this->sid = $data->osc_idx ?? null;
//        $this->osc_idx = $data->osc_idx ?? null;

        $this->event_code = $data->event_code ?? null;
        $this->memo = $data->memo ?? null;
        $this->year = $data->year ?? date('Y');
        $this->gubun = $data->gubun ?? null;
        $this->ccode = $data->ccode ?? '1';
        $this->subject = $data->subject;
        $this->content = $data->content ?? null;
        $this->place = $data->place ?? null;
        $this->limit_person = $data->limit_person ?? null;
        $this->date_type = $data->date_type ?? 'D';
        $this->event_sdate = $data->event_sdate ?? null;
        $this->event_edate = $data->event_edate ?? null;
        $this->regist_sdate = $data->regist_sdate ?? null;
        $this->regist_edate = $data->regist_edate ?? null;
        $this->result_sdate = $data->result_sdate ?? null;
        $this->result_edate = $data->result_edate ?? null;
        $this->result_date = $data->result_date ?? null;
        $this->hide = $data->hide ?? 'N';
        $this->del = $data->del ?? 'N';

        // 파일 업로드 경로
        $directory = config("site.overseas.conference.directory");

        // 썸네일파일
        $thumb = $data->file("thumb_file") ?? null;
        $thumb_delete = $data->thumb_del ??  null;

        // 파일 삭제이면서 기존 첨부파일 있을경우 경로에 있는 실제 파일 삭제
        if ($thumb_delete && !is_null($this->thumb_realfile)) {
            (new CommonServices())->fileDeleteService($this->thumb_realfile);

            // 첨부파일이 없다면 기존 파일경로 및 파일명 초기화
            if (is_null($thumb)) {
                $this->thumb_realfile = null;
                $this->thumb_file = null;
            }
        }

        // 첨부파일 있을경우 업로드후 경로 저장
        if ($thumb) {
            $uploadFile = (new CommonServices())->fileUploadService($thumb, $directory);
            $this->thumb_realfile = $uploadFile['realfile'];
            $this->thumb_file = $uploadFile['filename'];
        }
    }

    public function files()
    {
        return $this->hasMany(BoardFile::class, 'bsid');
    }

    public function downloadFileUrl($file, $name) // 게시판 첨부 파일 다운로드
    {
        return route('download', ['type' => 'only', 'tbl' => 'board', 'sid' => enCryptString($this->sid) , 'file' => $file, 'name' => $name]);
    }

    public function isNew($hour = 48) // 기본 48 시간 or 변수시간 기준으로 신규게시글 체크
    {
        return (now() <= $this->created_at->addHour($hour));
    }

    public function eventPeriod()
    {
        $sDate = date('m.d', strtotime($this->event_sDate));
        $sYoil = getYoil($this->event_sDate);

        $txt = "{$sDate} ({$sYoil})";

        if ($this->event_date_type === 'L') {
            $eDate = date('m.d', strtotime($this->event_eDate));
            $eYoil = getYoil($this->event_eDate);

            $txt .= " ~ {$eDate} ({$eYoil})";
        }

        return $txt;
    }

    public function overseas()
    {
        return $this->belongTo(Overseas::class, 'csid');
    }
}
