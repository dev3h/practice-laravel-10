<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentActionRequest;
use App\Http\Requests\StudentRequest;
use App\ModelFilters\StudentFilter;
use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(StudentRequest $request)
    {
        $search = $request->search;
        $sortColumn = $request->sortColumn ?? 'id';
        $sortType = $request->sortType ?? 'asc';
        $title = 'Quan ly sinh vien';
        $students = (new StudentFilter())->listStudent($search, $sortType, $sortColumn)
            ->paginate(10);
        // dd($students);
        $sortType = $sortType == 'asc' ? 'desc' : 'asc';
        return view('student.index', compact('search', 'sortColumn', 'sortType', 'students', 'title'));

        // $students = Student::with('classroom')->withoutGlobalScope(StudentScope::class)->studentClassroomGreater(40)->paginate(10);

        // dd($students);

    }
    public function getSoftDelete()
    {
        // $students = Student::onlyTrashed()->paginate(10);

        // return view('student.index', [
        //     'students' => $students,
        //     'title' => 'Quản lý học sinh',
        // ]);
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
    public function store(StudentActionRequest $request)
    {
        // $request->whenHas('name', function (string $input) {
        //     dd($input);
        // }, function () {
        //     return 'chua nhap kia';
        // });
        $random_str = Str::random(40);
        $ext = $request->photo->extension();
        $new_name_photo = $random_str . '.' . $ext;

        Storage::putFileAs('public/photo', $request->photo, $new_name_photo);
        // $request->merge(['created_by' => $request->user()->id]);
        $student = new Student;
        $student->name = $request->name;
        $student->classroom_id = $request->classroom_id;
        $student->created_by = $request->user()->id;
        $student->updated_by = $request->user()->id;
        $student->photo = $new_name_photo;
        $student->save();
        dd($student);

        return redirect(route('student.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::find($id);
        return view('student.show', compact('student'));
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
    public function update(StudentActionRequest $request, string $id)
    {
        $student = Student::find($id);

        if ($request->hasFile('photo')) {
            Storage::delete('public/photo/' . $student->photo);

            $random_str = Str::random(40);
            $ext = $request->photo->extension();
            $new_name_photo = $random_str . '.' . $ext;
            Storage::putFileAs('public/photo', $request->photo, $new_name_photo);

            $student->photo = $new_name_photo;

        }
        $student->name = $request->name;
        $student->classroom_id = $request->classroom_id;
        $student->updated_by = $request->user()->id;

        $student->save();

        return redirect(route('student.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::find($id);
        // $student->delete();
        $student->forceDelete();

        return redirect(route('student.index'));
    }
}
