<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = ['user_id','exam_form_id','data','status','amount_due','currency','reference_id','payment_method','pdf_path','created_by_admin']; 

    protected $casts = ['data'=>'array','amount_due'=>'decimal:2'];

    public function examForm(){ 
    	return $this->belongsTo(ExamForm::class); 
    } 
    public function payments(){ 
    	return $this->hasMany(Payment::class); 
    } 
    public function user(){ 
    	return $this->belongsTo(\App\User::class); 
    }
}
