<?php

namespace App\Models;

use App\Services\CommonServices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Overseas extends Model
{
    use HasFactory;

    public $table = 'overseas';

    protected $primaryKey = 'sid';

    protected $guarded = [
        'sid',
        'csid',
        'user_sid',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'qualification' => 'array',
        'top' => 'array',
        'registration_status' => 'array',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected static function booted()
    {
        parent::boot();

        static::deleting(function ($register) {

            // 데이터 삭제시 첨부파일(단일파일) 있을경우 경로에 있는 실제 파일 삭제
            if (!empty($register->file_path)) {
                (new CommonServices())->fileDeleteService($register->file_path);
            }
        });
    }

    public function setByData($data)
    {
        if(empty($this->sid)) {
            $this->user_sid = $data->user_sid ?? thisPk();
            $this->csid = $data->csid ?? null;
        }

        /**
         * DB이전
         */
//        $this->sid = $data->os_idx ?? null;
//        $this->os_idx = $data->os_idx ?? null;
//        $this->csid = $data->csid ?? null;
//        $this->user_sid = $data->user_sid ?? null;
//        $this->thumb_file = $data->thumb_file ?? null;
//        $this->thumb_realfile = $data->thumb_realfile ?? null;


        if($data->qualification){
            $this->qualification = $data->qualification ?? null;
        }
        if($data->top) {
            $this->top = $data->top ?? null;
        }
        if($data->title) {
            $this->title = $data->title ?? null;
        }
        if($data->author) {
            $this->author = $data->author ?? null;
        }
        if($data->submission_date) {
            $this->submission_date = $data->submission_date ?? null;
        }
        if($data->first) {
            $this->first = $data->first ?? null;
        }
        if($data->second) {
            $this->second = $data->second ?? null;
        }
        if($data->third) {
            $this->third = $data->third ?? null;
        }
        if($data->registration_status) {
            $this->registration_status = $data->registration_status ?? null;
        }
        if($data->participant) {
            $this->participant = $data->participant ?? null;
        }
        if($data->common_author) {
            $this->common_author = $data->common_author ?? null;
        }
        if($data->mail_date) {
            $this->mail_date = $data->mail_date ?? null;
        }
        if($data->mail_title) {
            $this->mail_title = $data->mail_title ?? null;
        }
        if($data->mail_from) {
            $this->mail_from = $data->mail_from ?? null;
        }
        if($data->mail_to) {
            $this->mail_to = $data->mail_to ?? null;
        }
        if($data->mail_content) {
            $this->mail_content = $data->mail_content ?? null;
        }
        if($data->abs_title) {
            $this->abs_title = $data->abs_title ?? null;
        }
        if($data->presenter) {
            $this->presenter = $data->presenter ?? null;
        }
        if($data->pay1) {
            $this->pay1 = unComma($data->pay1) ?? null;
        }
        if($data->pay2) {
            $this->pay2 = unComma($data->pay2) ?? null;
        }
        if($data->pay3) {
            $this->pay3 = unComma($data->pay3) ?? null;
        }
        if($data->pay4) {
            $this->pay4 = unComma($data->pay4) ?? null;
        }
        if($data->pay5) {
            $this->pay5 = unComma($data->pay5) ?? null;
        }
        if($data->tot_pay) {
            $this->tot_pay = unComma($data->tot_pay) ?? null;
        }
        if($data->bank_name) {
            $this->bank_name = $data->bank_name ?? null;
        }
        if($data->account_name) {
            $this->account_name = $data->account_name ?? null;
        }
        if($data->account_num) {
            $this->account_num = $data->account_num ?? null;
        }
        if($data->assistant) {
            $this->assistant = $data->assistant ?? null;
        }
        if($data->result) {
            $this->result = $data->result ?? 'U';
        }
        if($data->result_request_state) {
            $this->result_request_state = $data->result_request_state ?? 'N';
        }
        if($data->del) {
            $this->del = $data->del ?? 'N';
        }

        // 파일 업로드 경로
        $directory = config("site.overseas.directory");

        /* 첨부파일(단일파일) 업로드 or 삭제 */
        for ($i = 1; $i <= 10; $i++) {
            $file = $data->file("file{$i}") ?? null;
            $file_delete = $data->file_del.$i ?? null;

            // 파일 삭제이면서 기존 첨부파일 있을경우 경로에 있는 실제 파일 삭제
            if ($file_delete && !is_null($this->{'file_path' . $i})) {
                (new CommonServices())->fileDeleteService($this->{'file_path' . $i});

                // 첨부파일이 없다면 기존 파일경로 및 파일명 초기화
                if (is_null($file)) {
                    $this->{'realfile' . $i} = null;
                    $this->{'file' . $i} = null;
                }
            }

            // 첨부파일 있을경우 업로드후 경로 저장
            if ($file) {
                $uploadFile = (new CommonServices())->fileUploadService($file, $directory);
                $this->{'realfile' . $i} = $uploadFile['realfile'];
                $this->{'file' . $i} = $uploadFile['filename'];
            }
        }


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

    public function downloadFileUrl($file, $name) // 게시판 첨부 파일 다운로드
    {
        return route('download', ['type' => 'only', 'tbl' => 'overseas', 'sid' => enCryptString($this->sid) , 'file' => $file, 'name' => $name]);
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_sid')->withTrashed();
    }

    public function conference()
    {
        return $this->hasOne(OverseasConference::class, 'sid', 'csid');
    }
    
}
