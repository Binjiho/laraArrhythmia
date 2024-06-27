<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class MailSend extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'sid';

    protected $guarded = [
        'sid',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function setByData($data)
    {
        if(empty($this->sid)) {
            $this->ml_sid = $data['ml_sid'];
            $this->wiseu_seq = $data['wiseu_seq'];
        }

        $this->recipient_name = $data['recipient_name'];
        $this->recipient_email = $data['recipient_email'];
        $this->subject = $data['subject'];
        $this->contents = $data['contents'];
        $this->etc = $data['etc'];
    }

    public function mail()
    {
        return $this->belongsTo(MailList::class, 'ml_sid');
    }
}
