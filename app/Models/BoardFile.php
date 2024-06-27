<?php

namespace App\Models;

use App\Services\CommonServices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardFile extends Model
{
    use HasFactory;

    public $table = 'bbs_files';

    protected $primaryKey = 'sid';

    protected $guarded = [
        'sid',
        'bsid',
        'rsid',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected static function booted()
    {
        parent::boot();

        static::deleting(function ($file) {
            // 파일 데이터 삭제시 파일경로에 있는 실제 파일 삭제
            (new CommonServices())->fileDeleteService($file->realfile);
        });
    }

    public function setByData($data)
    {
        if (empty($this->sid)) {
            $this->bsid = $data['bsid'];
            $this->rsid = $data['rsid'] ?? null;
            $this->bbs_code = $data['bbs_code'];
        }

        $this->gubun = $data['gubun'] ?? null;
        $this->realfile = $data['realfile'];
        $this->filename = $data['filename'];
    }

    public function board()
    {
        return $this->belongsTo(Board::class, 'bsid');
    }

    public function downloadUrl()
    {
        return route('download', ['type' => 'only', 'tbl' => 'boardFile', 'sid' => enCryptString($this->sid)]);
    }
}