<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TeacherPosModel extends Model
{
    protected $table='teacher_position';     //教师定位表
    protected $primaryKey='pos_id';
    public $timestamps=false;
}
