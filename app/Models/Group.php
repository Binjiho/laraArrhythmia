<?php

namespace App\Models;

use App\Services\CommonServices;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $primaryKey = 'sid';

    protected $guarded = [
        'sid',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected static function booted()
    {
        parent::boot();

        static::deleting(function ($group) {
//            $group->members->delete();
            foreach($group->members as $member){
                $member->delete();
            }
            
            if (!empty($group->logo_realfile)) {
                (new CommonServices())->fileDeleteService($group->logo_realfile);
            }
        });
    }

    public function setByData($data)
    {
        $this->subject = $data['subject'];
        $this->hide = $data['hide'];

        // 로고 파일 삭제일 경우
        if (!empty($data->logo_del)) {
            (new CommonServices())->fileDeleteService($this->logo_realfile);

            $this->logo_realfile = null;
            $this->logo_filename = null;
        }

        // 로고 파일 있을경우
        $logFile = $data->file('logo');
        if (!empty($logFile)) {
            $uploadInfo = (new CommonServices())->fileUploadService($logFile, 'group');

            $this->logo_realfile = $uploadInfo['realfile'];
            $this->logo_filename = $uploadInfo['filename'];
        }
    }

    public function members()
    {
        return $this->hasMany(GroupMember::class, 'g_sid', 'sid')->orderby('sort');
    }

    public function group_conferences()
    {
        return $this->hasMany(GroupConference::class, 'g_sid', 'sid');
    }
}
