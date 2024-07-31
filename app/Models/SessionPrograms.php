<?php

namespace App\Models;

use App\Services\CommonServices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class SessionPrograms extends Model
{
    use HasFactory;

    public $table = 'session_programs';
    protected $primaryKey = 'sid';

    protected $guarded = [
        'sid',
        'bsid',
        'ssid',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected static function booted()
    {
        parent::boot();

        static::deleting(function ($board) {

            if (!empty($board->thumb_realfile)) {
                (new CommonServices())->fileDeleteService($board->thumb_realfile);
            }

        });
    }

    public function setByData($data)
    {
        if (empty($this->sid)) {
            $this->bsid = $data->bsid;
        }
        $this->ssid = $data->ssid ?? null;
        $this->title = $data->title ?? null;
        $this->time = $data->time ?? null;
        $this->speaker = $data->speaker ?? null;
        $this->link_url = $data->link_url ?? null;
        $this->sort = $data->sort ?? 1;

        /* 첨부파일(단일파일) 업로드 or 삭제 */

        // 파일 업로드 경로
        $directory = "program";

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
            $directory = ($directory . '/thumb');
            $uploadFile = (new CommonServices())->fileUploadService($thumb, $directory);
            $this->thumb_realfile = $uploadFile['realfile'];
            $this->thumb_file = $uploadFile['filename'];
        }
    }

    public function downloadFileUrl($file, $name) // 게시판 첨부 파일 다운로드
    {
        return route('download', ['type' => 'only', 'tbl' => 'session_programs', 'sid' => enCryptString($this->sid) , 'file' => $file, 'name' => $name]);
    }

    public function board()
    {
        return $this->belongsTo(Board::class, 'bsid')->withTrashed();
    }

    public function session()
    {
        return $this->belongsTo(Sessions::class, 'ssid')->withTrashed();
    }
}
