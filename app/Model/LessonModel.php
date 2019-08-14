<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LessonModel extends Model
{
    protected $table='lesson';     //教师表
    protected $primaryKey='lesson_id';
    public $timestamps=false;
}
