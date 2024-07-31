<?php

namespace App\Models;

use App\Services\CommonServices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    use HasFactory;

    public $table = 'conference';

    protected $primaryKey = 'sid';

    protected $guarded = [
        'sid',
        'user_sid',
    ];
    protected $casts = [
        'res_fee' => 'array',
        'abs_gubun' => 'array',
        'add_item' => 'array',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'event_sdate',
        'event_edate',
        'regist_sdate',
        'regist_edate',
        'abs_sdate',
        'abs_edate',
    ];

    protected static function booted()
    {
        parent::boot();

        static::deleting(function ($conference) {

            // 데이터 삭제시 첨부파일(단일파일) 있을경우 경로에 있는 실제 파일 삭제
            if (!empty($conference->thum_realfile)) {
                (new CommonServices())->fileDeleteService($conference->thum_realfile);
            }

            //있을경우 하나씩 삭제
            $conference->registrations()->each(function ($item) {
                $item->delete();
            });
            $conference->abstracts()->each(function ($item) {
                $item->delete();
            });
        });
    }

    public function setByData($data)
    {
        if(empty($this->sid)) {
        }

        /*DB이전*/
//        $this->sid = $data->conference_idx ?? null;
//        $this->conference_idx = $data->conference_idx ?? null;

        $this->event_date = $data->event_date ?? null;

        $this->hide = $data->hide ?? null;
        $this->detail = $data->detail ?? null;
        $this->category = $data->category ?? null;
        $this->year = $data->year ?? date('Y');
        $this->subject = $data->subject;
        $this->code = $data->code ?? null;

        $this->event_sdate = $data->event_sdate ?? null;
        $this->event_edate = $data->event_edate ?? null;
        $this->place = $data->place ?? null;
        $this->link_url = $data->link_url ?? null;
        $this->avg = $data->avg ?? null;
        $this->contact_name = $data->contact_name ?? null;

        $this->contact_tel = $data->contact_tel ?? null;
        $this->contact_email = $data->contact_email ?? null;
        $this->etc_text = $data->etc_text ?? null;
        $this->invite_text = $data->invite_text ?? null;
        $this->schedule_text = $data->schedule_text ?? null;

        $this->regist_yn = $data->regist_yn ?? null;
        $this->regist_sdate = $data->regist_sdate ?? null;
        $this->regist_edate = $data->regist_edate ?? null;
        $this->limit_yn = $data->limit_yn ?? 'N';
        $this->limit_person = $data->limit_person ?? null;

        $this->res_authority = $data->res_authority ?? null;
        $this->res_authority_etc = $data->res_authority_etc ?? null;
        $this->res_fee = $data->res_fee ?? null;
        $this->add_item = $data->add_item ?? null;
        $this->account = $data->account ?? null;

        $this->refund_text = $data->refund_text ?? null;
        $this->notice_text = $data->notice_text ?? null;
        $this->privacy_text = $data->privacy_text ?? null;
        $this->abs_yn = $data->abs_yn ?? null;
        $this->abs_sdate = $data->abs_sdate ?? null;

        $this->abs_edate = $data->abs_edate ?? null;
        $this->abs_authority = $data->abs_authority ?? null;
        $this->abs_gubun = $data->abs_gubun ?? null;
        $this->caution_text = $data->caution_text ?? null;
        $this->zipcode = $data->zipcode ?? null;

        $this->addr1 = $data->addr1 ?? null;
        $this->addr2 = $data->addr2 ?? null;
        $this->tel = $data->tel ?? null;

        $this->del = $data->del ?? 'N';

        // 파일 업로드 경로
        $directory = config("site.conference.directory");

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

    public function registrations()
    {
        return $this->hasMany(Registration::class, 'csid');
    }
    public function abstracts()
    {
        return $this->hasMany(Abstracts::class, 'csid');
    }

    public function downloadFileUrl($file, $name) // 게시판 첨부 파일 다운로드
    {
        return route('download', ['type' => 'only', 'tbl' => 'board', 'sid' => enCryptString($this->sid) , 'file' => $file, 'name' => $name]);
    }

    public function eventDate()
    {
        $event_date = $this->event_sdate->format('Y-m-d');

        if (!empty($this->event_edate) && $this->event_sdate != $this->event_edate) {
            $event_date = ($event_date . ' ~ ' . $this->event_edate->format('Y-m-d'));
        }

        return $event_date;
    }

    public function regDate()
    {
        if ($this->regist_yn == 'N') {
            return '';
        }

        if( !isValidTimestamp($this->regist_sdate) ){
            return '';
        }

        $reg_date = $this->regist_sdate->format('Y-m-d');

        if ($this->regist_edate) {
            $reg_date = ($reg_date . ' ~ ' . $this->regist_edate->format('Y-m-d'));
        }

        return $reg_date;
    }

    public function absDate()
    {
        if ($this->abs_yn == 'N') {
            return '';
        }

        if( !isValidTimestamp($this->abs_sdate) ){
            return '';
        }

        $abs_date = $this->abs_sdate->format('Y-m-d');

        if ($this->abs_edate) {
            $abs_date = ($abs_date . ' ~ ' . $this->abs_edate->format('Y-m-d'));
        }

        return $abs_date;
    }
}
