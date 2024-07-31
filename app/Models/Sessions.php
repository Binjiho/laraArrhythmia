<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Sessions extends Model
{
    use HasFactory;

    public $table = 'sessions';
    protected $primaryKey = 'sid';

    protected $guarded = [
        'sid',
        'bsid',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function setByData($data)
    {
        if (empty($this->sid)) {
            $this->bsid = $data->bsid;
        }
        $this->title = $data->title ?? null;
        $this->chair_person = $data->chair_person ?? null;
        $this->room = $data->room ?? null;
        $this->sort = $data->sort ?? 1;
    }

    public function board()
    {
        return $this->belongsTo(Board::class, 'bsid')->withTrashed();
    }

    public function programs()
    {
        return $this->hasMany(SessionPrograms::class, 'ssid')->where(['del'=>'N'])->orderBy('sort');
    }
}
