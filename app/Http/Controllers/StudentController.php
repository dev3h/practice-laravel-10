<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $sortColumn = $request->sortColumn ?? 'id';
        $sortType = $request->sortType ?? 'asc';
        $title = 'Quan ly sinh vien';
        // $students = Student::with('classroom')->withoutGlobalScope(StudentScope::class)->studentClassroomGreater(40)->paginate(10);
        $students = Student::with('user')->join('classrooms', 'classrooms.id', '=', 'students.classroom_id')
            ->select('students.*', 'classrooms.name as classroom_name')

            ->where('classrooms.name', 'LIKE', '%' . $search . '%')
            ->orWhere('students.id', $search)
            ->orWhere('students.name', 'LIKE', '%' . $search . '%')
            ->orderBy($sortColumn, $sortType)
            ->paginate(10);
        $sortType = $sortType == 'asc' ? 'desc' : 'asc';
        return view('student.index', compact('search', 'sortColumn', 'sortType', 'students', 'title'));

    }
    public function getSoftDelete()
    {
        $students = Student::onlyTrashed()->paginate(10);

        return view('student.index', [
            'students' => $students,
            'title' => 'Quản lý học sinh',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $request = request();
        // dd($request->user());
        $classrooms = Classroom::all();
        return view('student.create', [
            'classrooms' => $classrooms,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->whenHas('name', function (string $input) {
        //     dd($input);
        // }, function () {
        //     return 'chua nhap kia';
        // });
        $request->merge(['user_id' => $request->user()->id]);
        $student = $request->except('_token');

        Student::create($student);
        return redirect(route('student.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Student::find($id);
        $classrooms = Classroom::all();
        return view('student.edit', [
            'student' => $student,
            "classrooms" => $classrooms,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = Student::find($id);
        $request->merge(['user_id' => $request->user()->id]);
        $student->update($request->all());
        return redirect(route('student.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::find($id);
        $student->delete();
        return redirect(route('student.index'));
    }
}
