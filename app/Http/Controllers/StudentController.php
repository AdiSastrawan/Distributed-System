<?php

namespace App\Http\Controllers;

use App\Models\Student;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();
        return response()->json(["data" => $students]);
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $student = Student::create(["id" => $request->id, "nama" => $request->nama, "alamat" => $request->alamat, "telepon" => $request->telepon]);
        return response()->json(["data" => $student]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        return response()->json(["data" => $student]);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $student->update(["id" => $request->id, "nama" => $request->nama, "alamat" => $request->alamat, "telepon" => $request->telepon]);
        return response()->json(["data" => $student]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return response()->json(["data" => $student], 204);
    }
}
