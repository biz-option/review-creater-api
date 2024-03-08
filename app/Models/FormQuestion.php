<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_id',
        'question',
        'question_type',
        'question_part_texts',
        'sort_order',
    ];

    public function form() {
        return $this->belongsTo('App\Models\From');
    }
}
