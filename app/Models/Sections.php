<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Sections extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['Name_Section'];
    protected $fillable=['Name_Section','Grade_id','Class_id'];

    protected $table = 'sections';
    public $timestamps = true;



    public function My_classs()
    {
        return $this->belongsTo(Classroom::class, 'Class_id');
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class,'teacher_section','section_id','teacher_id');
    }

    public function Grades(){
        return $this->belongsTo(Grade::class,'Grade_id');
    }
    public function student(){
        return $this->hasMany(Student::class,'section_id');
    }
}
