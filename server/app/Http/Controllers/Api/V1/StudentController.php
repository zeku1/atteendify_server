<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // if (!$request->user()->tokenCan('teacher')) {
        //     return response()->json(['message' => 'Unauthorized'], 403);
        // }

        $students = Student::all();

        if(!$students){
            return response()->json([
                'message' => 'Failed to retrieve data.',
            ],500);
        }

        return response()->json([
            'message' => 'Success!',
           'student' => $students->load('sections')
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {

        $student->load('sections');

        if($student==null){
            response()->json([
                'message' => 'Student not found.' 
            ], 404);
        }
       
        return response()->json([
            'student' => $student
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }
}
