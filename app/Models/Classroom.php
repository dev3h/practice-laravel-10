<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    public function student() {
        return $this->hasMany(Student::class);
    }
    public function getIdAttribute($value) {
        return "#Lop " . $value;
    }
    public function setNameAttribute($value) {
        $this->attributes['name'] =  "Dev3h " . $value;
    }
}
