<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BoardReply extends Model
{
    use HasFactory;

    public $table = 'bbs_replies';
    protected $primaryKey = 'sid';

    protected $guarded = [
        'sid',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function setByData($data)
    {
        if (empty($this->sid)) {
            $this->bsid = $data->bsid;
            $this->user_sid = $data->user_sid ?? thisPk();
            $this->writer = $data->writer ?? thisUser()->name_kr;
            $this->email = $data->email ?? thisUser()->email;
        }

        $this->subject = $data->subject;
        $this->content = $data->content;
        $this->link_url = $data->link_url ?? null;
    }

    public function board()
    {
        return $this->hasOne(Board::class, 'sid', 'bsid');
    }

    public function files()
    {
        return $this->hasMany(BoardFile::class, 'rsid', 'sid');
    }

    public function plDownloadUrl() // 게시판 plupload 전체 파일 다운로드
    {
        switch ($this->files()->count()) {
            case 0: // 파일이 없을경우 (그럴일 없겠지만 혹시나)
                return 'javascript:void(0);';

            case 1: // 게시판 plupload 파일이 하나일 경우 파일만 다운로드
                return $this->files[0]->downloadUrl();

            default: // 게시판 plupload 파일이 여러개일 경우 압축 파일로 다운로드
                return route('download', ['type' => 'zip', 'tbl' => 'reply', 'sid' => enCryptString($this->sid)]);
        }
    }

    public function user()
    {
        return $this->hasOne(User::class, 'sid', 'user_sid')->withTrashed();
    }
}
