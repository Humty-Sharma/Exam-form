<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    protected $fillable = [
        'exam_form_id', 'field_key', 'label', 'type', 'validation_rules', 'options', 'order'
    ];

    protected $casts = [
        // 'validation_rules' => 'array',
        'options' => 'array',
    ];

    public function examForm()
    {
        return $this->belongsTo(ExamForm::class);
    }
}
