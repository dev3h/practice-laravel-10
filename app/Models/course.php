<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    use HasFactory;
    //  use HasUuids;

    protected $table = 'my_courses';
    protected $primary ='code';
    // public $incrementing = false;
    // public $timestamps = false;
    protected $keyType = 'string';
    protected $attributes  = [
        'name' => "khóa học mặc định"
    ];
    protected $casts = [
        "student_id" => Student::class
    ];
}
