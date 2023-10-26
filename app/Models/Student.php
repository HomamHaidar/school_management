<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Translatable\HasTranslations;

class Student extends Authenticatable

{
    use SoftDeletes;
    use HasFactory;
    use HasTranslations;
    public $translatable = ['name'];
    protected $guarded=[];

     public function gender(){
       return   $this->belongsTo(Gender::class,'gender_id');
     }

    public function Nationality(){
        return $this->belongsTo(Nationalitie::class,"nationalitie_id");
    }

     public function grade(){
       return   $this->belongsTo(Grade::class,'Grade_id');
     }

     public function classroom(){
         return $this->belongsTo(Classroom::class,'Classroom_id');

     }

     public function section(){
         return $this->belongsTo(Sections::class,'section_id');
     }

    public function myparent(){
        return $this->belongsTo(My_Parent::class,'parent_id');
    }

    public function images(){

         return $this->morphMany(Image::class,'imageable');
    }

    public function student_account(){
         return $this->hasMany(StudentAccount::class,'student_id');
    }

   public function attendance()
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }





}
