<?php 
namespace App\ModelFilters;
use App\Models\Student;

class StudentFilter extends Student {
    public function getAllStudent() {
        return $this->all();
    }
    public function listStudent($search, $sortType, $sortColumn) {
        return $this->join('classrooms', 'classrooms.id', '=', 'students.classroom_id')
            ->leftJoin('users as created_users', 'students.created_by', '=', 'created_users.id')
            ->leftJoin('users as updated_users', 'students.updated_by', '=', 'updated_users.id')
            ->select('students.*', 'classrooms.name as classroom_name', 'created_users.email as created_by_email', 'updated_users.email as updated_by_email')
            ->where(function ($query) use ($search) {
                $query->where('classrooms.name', 'LIKE', '%' . $search . '%')
                    ->orWhere('students.id', $search)
                    ->orWhere('students.name', 'LIKE', '%' . $search . '%')
                    ->orWhere('created_users.email', 'LIKE', '%' . $search . '%')
                    ->orWhere('updated_users.email', 'LIKE', '%' . $search . '%');
            })
            ->orderBy($sortColumn, $sortType)
            ->where('classrooms.deleted_at', null);
    }
}