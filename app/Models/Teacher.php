<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Translatable\HasTranslations;

class Teacher extends Authenticatable
{
    use HasFactory;
    use HasTranslations;
    protected $fillable=['email','password','Name','Specialization_id','Gender_id','Joining_Date','Address'];
     public $translatable=['Name'];

    public function genders(){
        return   $this->belongsTo(Gender::class,'Gender_id');
    }
    public function specializations(){
        return   $this->belongsTo(Specialization::class,'Specialization_id');
    }
    public function sections()
    {
        return $this->belongsToMany(Sections::class,'teacher_section','teacher_id','section_id');
    }
}
