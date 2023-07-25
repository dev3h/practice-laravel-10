<?php

namespace App\Models;

use App\Models\Scopes\StudentScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'classroom_id'
    ];
    protected $appends = ['age'];
    protected $dates = ['deleted_at'];

    public function classroom() {
        return $this->belongsTo(Classroom::class);
    }


     protected static function booted(): void
    {
        static::addGlobalScope(new StudentScope);
    }

    public function scopeStudentClassroomGreater($query, $number) {
        return $query->where('classroom_id', '>', $number);
    }
    public function getAgeAttribute() {
        return $this->attributes['age'] = 18;
    }
}
