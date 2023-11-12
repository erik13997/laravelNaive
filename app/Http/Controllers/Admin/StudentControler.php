<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StudentCreateRequest;
use App\Http\Requests\Admin\StudentUpdateRequest;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentControler extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::paginate(30);
        return view("admin.student.index", compact("students"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.student.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StudentCreateRequest $request)
    {
        Student::create($request->validated());
        return redirect()->route("student.index")->with('toast_success', 'Student Create Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        return view("admin.student.edit", compact("student"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StudentUpdateRequest $request, Student $student)
    {
        $student->update($request->validated());
        return redirect()->route("student.index")->with('toast_success', 'Student Update Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return back()->with('toast_success', 'Student Deleted Successfully!');
    }
}
