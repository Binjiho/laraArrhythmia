<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardCounter extends Model
{
    use HasFactory;

    public $table = 'bbs_read';

    public $timestamps = false;

    protected $primaryKey = 'sid';

    protected $guarded = [
        'sid',
        'b_sid',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function setByData($data)
    {
        $this->bbs_code = $data['code'];
        $this->bsid = $data['sid'];
        $this->ip = request()->ip();
        $this->created_at = now();

        if (thisAuth()->check()) {
            $this->user_sid = thisPk();
            $this->user_id = thisUser()->uid;
        }
    }
}
