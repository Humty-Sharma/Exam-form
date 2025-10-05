<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['submission_id','user_id','gateway','gateway_payment_id','amount','currency','status','raw_response','captured_at']; 
    
    protected $casts = ['raw_response'=>'array','amount'=>'decimal:2','captured_at'=>'datetime']; 
    
    public function submission(){ 
        return $this->belongsTo(Submission::class); 
    } 
    public function user(){ 
        return $this->belongsTo(\App\User::class); 
    }
}
