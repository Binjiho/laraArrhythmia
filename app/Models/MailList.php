<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MailList extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'sid';

    protected $guarded = [
        'sid',
    ];

    protected $dates = [
        'send_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'level' => 'array',
    ];

    public function setByData($data, $file = [])
    {
        $sendType = $data->send_type;
        $useBtn = $data->use_btn;

        $this->template = $data->template;
        $this->sender_name = $data->sender_name;
        $this->sender_mail = $data->sender_mail;
        $this->subject = $data->subject;
        $this->contents = $data->contents;
        $this->send_type = $sendType;

        if($data->use_send === 'Y') {
            $this->send_date = date('Y-m-d H:i:s');
            $this->thread = (($this->thread ?? 0) + 1);
        }

        $this->use_btn = $useBtn;
        $this->link_url = ($useBtn == 9) ? null : $data->link_url;
        $this->level = ($sendType == 1) ? $data->level : null;
        $this->ma_sid = ($sendType == 2) ? $data->ma_sid : null;
        $this->test_email = ($sendType == 9) ? $data->test_email : null;

        // 최초 생성시 파일 등록
        if (empty($this->sid)) {
            if($file) {
                $this->file = jsonUnicode($file);
            }
        }else {
            // 수정시 파일 등록
            $origin_file = empty($this->file) ? [] : json_decode($this->file);
            $del_file = empty($data->del_file) ? null : json_decode($data->del_file);

            // 삭제 파일있을경우 데이터 삭제
            if($del_file) {
                foreach ($origin_file as $key => $row) {
                    if(in_array($row->file_path, $del_file)) {
                        unset($origin_file[$key]);
                    }
                }
            }

            // 신규등록 파일 있을경우 기존파일에 업데이트
            if($file) {
                foreach ($file as $row) {
                    array_push($origin_file, (object)$row);
                }
            }

            $origin_file = array_values($origin_file);

            $this->file = jsonUnicode($origin_file);
        }
    }

    public function downloadFileUrl($file, $name) // 첨부 파일 다운로드
    {
        return route('download', ['type' => 'only', 'tbl' => 'mail_list', 'sid' => enCryptString($this->sid) , 'file' => $file, 'name' => $name]);
    }

    public function totMail()
    {
        return $this->hasMany(MailSend::class, 'ml_sid');
    }

    public function sucMail()
    {
        return $this->hasMany(MailSend::class, 'ml_sid')->where('status', 'S');
    }

    public function failMail()
    {
        return $this->hasMany(MailSend::class, 'ml_sid')->where('status', 'F');
    }

    public function readyMail()
    {
        return $this->hasMany(MailSend::class, 'ml_sid')->where('status', 'R');
    }

    public function mailCnt()
    {
        return $this->totMail()
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();
    }
}
