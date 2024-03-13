<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'review_id',
        'question',
        'answer',
    ];

    public function review() {
        return $this->belongsTo(Review::class);
    }
}
