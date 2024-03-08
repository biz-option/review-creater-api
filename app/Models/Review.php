<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'form_id',
    ];

    public function details() {
        return $this->hasMany('App\Models\ReviewDetail');
    }
}
