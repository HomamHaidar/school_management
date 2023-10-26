<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee_invoices extends Model
{
    use HasFactory;
    public function student(){
        return $this->belongsTo(Student::class,'student_id');
    }
    public function grade(){
        return $this->belongsTo(Grade::class,'Grade_id');
    }
    public function classroom(){
        return $this->belongsTo(classroom::class,'Classroom_id');
    }
    public function fees(){
        return $this->belongsTo(Fee::class,'fee_id');
    }


}
