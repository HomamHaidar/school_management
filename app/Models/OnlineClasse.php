<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineClasse extends Model
{
    use HasFactory;
    public $fillable= ['Grade_id','Classroom_id','section_id','user_id','meeting_id','topic','start_at','duration','password','start_url','join_url'];

}
