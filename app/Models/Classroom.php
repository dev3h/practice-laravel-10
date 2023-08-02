<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classroom extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['name'];
    public function students()
    {
        return $this->hasMany(Student::class);
    }
    // public function getIdAttribute($value) {
    //     return "#Lop " . $value;
    // }
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = "Dev3h " . $value;
    }
}
