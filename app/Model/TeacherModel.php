<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TeacherModel extends Model
{
    protected $table='teacher';     //教师表
    protected $primaryKey='teacher_id';
    public $timestamps=false;
}
