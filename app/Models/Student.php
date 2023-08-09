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
    protected $table = 'students';
    protected $fillable = [
        'name',
        'photo',
        'classroom_id',
        'created_by',
        'updated_by'
    ];
    protected $appends = ['age'];
    protected $dates = ['deleted_at'];

    public function classroom() {
        return $this->belongsTo(Classroom::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }


    //  protected static function booted(): void
    // {
    //     static::addGlobalScope(new StudentScope);
    // }

    // public function scopeStudentClassroomGreater($query, $number) {
    //     return $query->where('classroom_id', '>', $number);
    // }
    public function getAgeAttribute() {
        return $this->attributes['age'] = 18;
    }
}
