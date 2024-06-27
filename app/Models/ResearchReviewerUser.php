<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResearchReviewerUser extends Model
{
    public $table = 'research_reviewer_user';

    protected $fillable = [
        'research_sid',
        'research_reviewer_sid',
    ];
}
