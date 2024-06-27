<?php

namespace App\Models;

use App\Services\CommonServices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;

    public $table = 'bbs_tbl';

    protected $primaryKey = 'sid';

    protected $guarded = [
        'sid',
        'bbs_code',
        'user_sid',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected static function booted()
    {
        parent::boot();

        static::deleting(function ($board) {
//            $board->comments()->delete();

            // 게시판 데이터 삭제시 첨부파일(단일파일) 있을경우 경로에 있는 실제 파일 삭제
            if (!empty($board->bbs_realfile1)) {
                (new CommonServices())->fileDeleteService($board->bbs_realfile1);
            }

            if (!empty($board->bbs_realfile2)) {
                (new CommonServices())->fileDeleteService($board->bbs_realfile2);
            }

            if (!empty($board->bbs_realfile3)) {
                (new CommonServices())->fileDeleteService($board->bbs_realfile3);
            }

            if (!empty($board->bbs_realfile4)) {
                (new CommonServices())->fileDeleteService($board->bbs_realfile4);
            }

            if (!empty($board->bbs_realfile5)) {
                (new CommonServices())->fileDeleteService($board->bbs_realfile5);
            }

            if (!empty($board->thumb_realfile)) {
                (new CommonServices())->fileDeleteService($board->thumb_realfile);
            }

            // 답변이 있을경우 하나씩 삭제
//            $board->replies()->each(function ($reply) {
//                $reply->delete();
//            });

            // 첨부파일 (plupload) 있을경우 하나씩 삭제
            $board->files()->each(function ($file) {
                $file->delete();
            });
        });
    }

    public function setByData($data)
    {
        if(empty($this->sid)) {
            $this->bbs_code = $data['code'];
            $this->user_sid = thisPk();
            $this->name = $data['name'];
            $this->ip = request()->ip();
        }

        $this->abyear = $data['abyear'] ?? null;
        $this->category = $data['category'] ?? null;
        $this->category2 = $data['category2'] ?? null;
        $this->gubun = $data['gubun'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->phone = $data['phone'] ?? null;
        if($data['subject']){
            $this->subject = $data['subject'];
        }
        $this->subject2 = $data['subject2'] ?? null;

        $this->date_type = $data['date_type'] ?? 'D';
        $this->sdate = $data['sdate'] ?? null;
        $this->stime = $data['stime'] ?? null;
        $this->edate = ($this->date_type == 'D') ? null : $data['edate'];
        $this->etime = $data['etime'] ?? null;
        $this->place = $data['place'] ?? null;
        if($data['content']) {
            $this->content = $data['content'] ?? null;
        }
        $this->content2 = $data['content2'] ?? null;
        $this->linkurl = $data['linkurl'] ?? null;
        $this->linkurl2 = $data['linkurl2'] ?? null;
        $this->p_date = $data['p_date'] ?? null;
        $this->popup_type = $data['popup_type'] ?? null;
        $this->notice = $data['notice'] ?? 'N';
        $this->popup = $data['popup'] ?? 'N';
        $this->event_sdate = $data['event_sdate'] ?? null;
        $this->event_edate = $data['event_edate'] ?? null;
        $this->regist_sdate = $data['regist_sdate'] ?? null;
        $this->regist_edate = $data['regist_edate'] ?? null;
        $this->abs_sdate = $data['abs_sdate'] ?? null;
        $this->abs_edate = $data['abs_edate'] ?? null;
        $this->popup_show = $data['popup_show'] ?? 'N';
        $this->app_push = $data['app_push'] ?? 'N';
        $this->open = $data['open'] ?? 'Y';
        $this->push = $data['push'] ?? 'N';
        $this->hide = $data['hide'] ?? 'N';
        $this->passwd = $data['passwd'] ?? null;

        $this->popup_skin = $data['popup_skin'] ?? '0';
        $this->popup_select = $data['popup_select'] ?? 'N';
        $this->popup_content = $data['popup_content'] ?? null;
        $this->popup_width = $data['popup_width'] ?? null;
        $this->popup_height = $data['popup_height'] ?? null;
        $this->popup_position_x = $data['popup_position_x'] ?? null;
        $this->popup_position_y = $data['popup_position_y'] ?? null;
        $this->popup_detail = $data['popup_detail'] ?? null;
        $this->popup_linkurl = $data['popup_linkurl'] ?? null;
        $this->popup_close = $data['popup_close'] ?? null;
        $this->popup_scroll = $data['popup_scroll'] ?? null;
        $this->popup_startdate = $data['popup_startdate'] ?? null;
        $this->popup_enddate = $data['popup_enddate'] ?? null;



        /* 첨부파일(단일파일) 업로드 or 삭제 */

        // 파일 업로드 경로
        $directory = config("site.board.{$data['code']}.directory");

        for ($i = 1; $i <= 5; $i++) {
            $file = $data->file("file{$i}") ?? null;
            $file_delete = $data->file1_del ??  null;

            // 파일 삭제이면서 기존 첨부파일 있을경우 경로에 있는 실제 파일 삭제
            if ($file_delete && !is_null($this->bbs_realfile1)) {
                (new CommonServices())->fileDeleteService($this->bbs_realfile1);

                // 첨부파일이 없다면 기존 파일경로 및 파일명 초기화
                if (is_null($file)) {
                    $this->bbs_realfile1 = null;
                    $this->bbs_file1 = null;
                }
            }

            // 첨부파일 있을경우 업로드후 경로 저장
            if ($file) {
                $uploadFile = (new CommonServices())->fileUploadService($file, $directory);
                $this->bbs_realfile1 = $uploadFile['realfile'];
                $this->bbs_file1 = $uploadFile['filename'];
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
            $directory = ($directory . '/thumb');
            $uploadFile = (new CommonServices())->fileUploadService($thumb, $directory);
            $this->thumb_realfile = $uploadFile['realfile'];
            $this->thumb_file = $uploadFile['filename'];
        }
    }

    public function files()
    {
        return $this->hasMany(BoardFile::class, 'bsid');
    }

    public function replies()
    {
        return $this->hasMany(BoardReply::class, 'bsid');
    }

    public function downloadFileUrl($file, $name) // 게시판 첨부 파일 다운로드
    {
        return route('download', ['type' => 'only', 'tbl' => 'board', 'sid' => enCryptString($this->sid) , 'file' => $file, 'name' => $name]);
    }

//    public function downloadUrl() // 게시판 첨부 파일 다운로드
//    {
//        return route('download', ['type' => 'only', 'tbl' => 'board', 'sid' => enCryptString($this->sid)]);
//    }

    public function plDownloadUrl() // 게시판 plupload 전체 파일 다운로드
    {
        switch ($this->files()->count()) {
            case 0: // 파일이 없을경우 (그럴일 없겠지만 혹시나)
                return 'javascript:void(0);';

            case 1: // 게시판 plupload 파일이 하나일 경우 파일만 다운로드
                return $this->files[0]->downloadUrl();

            default: // 게시판 plupload 파일이 여러개일 경우 압축 파일로 다운로드
                return route('download', ['type' => 'zip', 'tbl' => 'board', 'sid' => enCryptString($this->sid)]);
        }
    }

    public function isNew($hour = 48) // 기본 48 시간 or 변수시간 기준으로 신규게시글 체크
    {
        return (now() <= $this->created_at->addHour($hour));
    }

    public function categoryTxt()
    {
        $category = $this->category;
        $boardConfig = config("site.board.{$this->code}");

        if ($boardConfig['category']['type'] == 'checkbox') {
            $category = json_decode($category, true);

            foreach ($boardConfig['category']['item'] as $key => $val) {
                if (in_array($key, $category)) {
                    $categoryArr[] = $val;
                }
            }

            return implode(' ', $categoryArr);
        }

        return $boardConfig['category']['item'][$category];
    }

    public function category2Txt()
    {
        $category2 = $this->category2;
        $boardConfig = config("site.board.{$this->code}");

        if ($boardConfig['category2']['type'] == 'checkbox') {
            $category2 = json_decode($category2, true);

            foreach ($boardConfig['category']['item'] as $key => $val) {
                if (in_array($key, $category2)) {
                    $categoryArr[] = $val;
                }
            }

            return implode(' ', $categoryArr);
        }

        return $boardConfig['category2']['item'][$category2];
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
}
