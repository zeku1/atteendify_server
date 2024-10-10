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
        $students = Student::all();

        if(!$students){
            return response()->json([
                'error_message' => 'Failed to retrieve data.',
            ],500);
        }

        return response()->json([
            'message' => 'Success!',
           'student' => $students
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $student = Student::with('sections')
                            ->where('id',$id)
                            ->first();

        if($student==null){
            response()->json([
                'error_message' => 'Student not found.' 
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
