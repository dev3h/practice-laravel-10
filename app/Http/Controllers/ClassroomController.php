<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClassroomRequest;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ClassroomController extends Controller
{
    public function handleLog(string $id) {
        // Log::emergency('show the class info with {id}', ['id'=> $id]);
        // Log::alert('show the class info with {id}', ['id'=> $id]);
        // Log::critical('show the class info with {id}', ['id'=> $id]);
        // Log::error('show the class info with {id}', ['id'=> $id]);
        // Log::warning('show the class info with {id}', ['id'=> $id]);
        // Log::notice('show the class info with {id}', ['id'=> $id]);
        Log::info('show the class info with {id}', ['id'=> $id]);
        // Log::debug('show the class info with {id}', ['id'=> $id]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classrooms = Classroom::all();
        return view('classroom/index', [
            "classrooms"=> $classrooms,
            "title"=> "<h2>Quản lý lớp học</h2>"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('classroom/create');
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClassroomRequest $request)
    {
        // $request->validate([
        //     'name'=> 'required|max:255'
        // ]);
        $classroom = Classroom::create($request->except('_token'));
       if($classroom) {
        return redirect(route('classroom.index'));
       };
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->handleLog($id);
       
        return "Xem log ở storage/logs";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $classroom = Classroom::find($id);
        return view('classroom.edit', [
            "classroom"=>$classroom
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $classroom = Classroom::find($id);
        $classroom->update($request->all());
        
        return redirect(route('classroom.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $classroom = Classroom::find($id);
        $classroom->delete();

        return redirect(route('classroom.index'));
    }
}
