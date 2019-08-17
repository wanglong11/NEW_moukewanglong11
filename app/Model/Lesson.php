<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    public $table = 'lesson';
    protected $primaryKey='lesson_id';
    public $timestamps=false;
}
