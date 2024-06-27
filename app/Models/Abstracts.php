<?php

namespace App\Models;

use App\Services\CommonServices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Abstracts extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'abstracts';

    protected $primaryKey = 'sid';

    protected $guarded = [
        'sid',
        'csid',
        'user_sid',
    ];
    protected $casts = [
        'p_phone' => 'array',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function booted()
    {
        parent::boot();

        static::deleting(function ($conference) {
            // 데이터 삭제시 첨부파일(단일파일) 있을경우 경로에 있는 실제 파일 삭제
            if (!empty($conference->thum_realfile)) {
                (new CommonServices())->fileDeleteService($conference->thum_realfile);
            }
        });
    }

    public function setByData($data)
    {
        if(empty($this->sid)) {
            $this->csid = $data->csid;
            $this->regnum = $data->regnum;
            $this->year = $data->year ?? date('Y');
            $this->user_sid = thisPk();
            $this->uid = $data->uid;
            $this->ip = request()->ip;
        }
        $this->name_kr = $data->name_kr;
        $this->type = $data->type ?? null;
        $this->gubun = $data->gubun ?? null;
        $this->status = $data->status ?? 'N';

        $this->title_kr = $data->title_kr ?? null;
        $this->title_en = $data->title_en ?? null;
        $this->research_kr = $data->research_kr ?? null;
        $this->research_en = $data->research_en ?? null;
        $this->sosok_kr = $data->sosok_kr ?? null;
        $this->sosok_en = $data->sosok_en ?? null;

        if($this->type == 'O'){
            $this->o_intro = $data->o_intro ?? null;
            $this->o_case = $data->o_case ?? null;
            $this->o_result = $data->o_result ?? null;

            $this->p_object = null;
            $this->p_method = null;
            $this->p_result = null;
            $this->p_conclusion = null;
        }else if($this->type == 'P'){
            $this->o_intro = null;
            $this->o_case = null;
            $this->o_result = null;

            $this->p_object = $data->p_object ?? null;
            $this->p_method = $data->p_method ?? null;
            $this->p_result = $data->p_result ?? null;
            $this->p_conclusion = $data->p_conclusion ?? null;
        }
        $this->tot_byte = $data->tot_byte ?? null;

        $this->p_name = $data->p_name ?? null;
        $this->p_sosok = $data->p_sosok ?? null;
        $this->p_position = $data->p_position ?? null;
        $this->p_position_etc = $data->p_position_etc ?? null;
        $this->p_email = $data->p_email ?? null;
        $this->p_phone = $data->p_phone ?? null;

        $this->del = $data['del'] ?? 'N';

        // 파일 업로드 경로
        $directory = "abstract";

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

    private function conferenceConfig()
    {
        return config('site.conference');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'sid', 'user_sid')->withTrashed();
    }

    public function conference()
    {
        return $this->hasOne(Conference::class, 'sid', 'csid');
    }

    public function getAbsType()
    {
        return self::conferenceConfig()['abs_type'][$this->type];
    }

    public function downloadFileUrl($file, $name) // 게시판 첨부 파일 다운로드
    {
        return route('download', ['type' => 'only', 'tbl' => 'board', 'sid' => enCryptString($this->sid) , 'file' => $file, 'name' => $name]);
    }

}
