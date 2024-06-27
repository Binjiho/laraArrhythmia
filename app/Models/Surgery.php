<?php

namespace App\Models;

use App\Services\CommonServices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Surgery extends Model
{
    use HasFactory;

    public $table = 'surgery';

    protected $primaryKey = 'sid';

    protected $guarded = [
        'sid',
        'user_sid',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
//        'qualification' => 'array',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'certi_date',
        'renewal_date',
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
            $this->user_sid = thisPk();
            $this->regnum = $data->regnum ?? null;
        }

        /**
         * DB 이전
         */
//        $this->sid = $data->sid;
//        $this->surgery_idx = $data->surgery_idx;
//        $this->user_sid = $data->user_sid;
//        $this->uid = $data->uid;
//        $this->file1 = $data->file1 ?? null;
//        $this->file2 = $data->file2 ?? null;
//        $this->file3 = $data->file3 ?? null;
//        $this->realfile1 = $data->realfile1 ?? null;
//        $this->realfile2 = $data->realfile2 ?? null;
//        $this->realfile3 = $data->realfile3 ?? null;

        if($data->certi_date) {
            $this->certi = $data->certi ?? null;
            $this->certi_date = $data->certi_date ?? null;
            $this->renewal_date = $this->certi_date->addYear(5);
        }

        if($data->mregnum) {
            $this->mregnum = $data->mregnum ?? null;
        }

        $this->year = $data->year ?? date('Y');

        if($data->detail1) {
            $this->detail1 = $data->detail1 ?? null;
        }
        if($data->detail2){
            $this->detail2 = $data->detail2 ?? null;
        }
        if($data->detail3) {
            $this->detail3 = $data->detail3 ?? null;
        }
        if($data->detail4) {
            $this->detail4 = $data->detail4 ?? null;
        }
        if($data->detail5) {
            $this->detail5 = $data->detail5 ?? null;
        }
        if($data->etc1) {
            $this->etc1 = $data->etc1 ?? null;
        }
        if($data->etc2) {
            $this->etc2 = $data->etc2 ?? null;
        }
        if($data->name1) {
            $this->name1 = $data->name1 ?? null;
        }
        if($data->name2) {
            $this->name2 = $data->name2 ?? null;
        }

        if($data->result) {
            $this->result = $data->result ?? 'N';
        }
        if($data->del) {
            $this->del = $data->del ?? 'N';
        }

        // 파일 업로드 경로
        $directory = config("site.surgery.directory");

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
                $this->{'realfile' . $i} = $uploadFile->realfile;
                $this->{'file' . $i} = $uploadFile->filename;
            }
        }

    }

    public function downloadFileUrl($file, $name) // 게시판 첨부 파일 다운로드
    {
        return route('download', ['type' => 'only', 'tbl' => 'surgery', 'sid' => enCryptString($this->sid) , 'file' => $file, 'name' => $name]);
    }


//    public function user()
//    {
//        return $this->belongsTo(User::class, 'user_sid')->withTrashed();
//    }

    public function user()
    {
        return $this->hasOne(User::class, 'sid', 'user_sid')->withTrashed();
    }

    public function cases()
    {
        return $this->hasMany(SurgeryCase::class, 'surgery_sid')->where('del','=','N');
    }

    public function careers()
    {
        return $this->hasMany(Career::class, 'surgery_sid')->where('del','=','N');
    }

    //sync
    public function surgery_reviewer()
    {
        return $this->belongsToMany(Reviewer::class, 'surgery_result', 'surgery_sid', 'reviewer_sid');
    }

//    public function surgery_result()
//    {
//        return $this->hasMany(SurgeryResult::class, 'surgery_sid');
//    }

    public function surgery_result($surgery_sid, $reviewer_sid)
    {
        return SurgeryResult::where(['surgery_sid'=>$surgery_sid, 'reviewer_sid'=>$reviewer_sid ])->first();
    }

}
