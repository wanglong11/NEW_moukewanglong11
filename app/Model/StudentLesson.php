<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StudentLesson extends Model
{
    public $table ='student_lesson';
    protected $primaryKey='user_id';
    public $timestamps=false;
}
