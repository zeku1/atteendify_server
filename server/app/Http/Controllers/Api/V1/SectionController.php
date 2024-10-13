<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ClassParticipant;
use App\Models\Student;
use App\Models\Teacher;

use function Laravel\Prompts\error;

class SectionController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function addStudents(Request $request)
    {
        $validated = $request->validate([
            'class_id' => 'required|integer',
            'student_ids' => 'required|array',

        ]);

        $classId = $validated['class_id'];
        $students = $validated['student_ids'];

        foreach($students as $student){
            $enrolled = ClassParticipant::create([
                'section_id' => $classId,
                'student_id' => $student
            ]);
        }

        return response()->json([
            'message' => 'Students processed successfully!'
        ], 200);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        $sectionsByTeacher = Section::where('teacher_id', $request->id)->get();

        if ($sectionsByTeacher->isEmpty()) {
            return response()->json([
                'error_message' => 'No data found'
            ], 404);
        }
        
        return response()->json([
            'message' => 'Classes have been found',
            'classes' => $sectionsByTeacher
        ], 302);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'section_name' => 'required|string',
            'teacher_id' => 'required|integer',
            'semester' => 'required|string'
        ]);
        
        $isAlreadySaved = Section::where('section_name', $request->section_name)
                                    ->where('year', date("Y"))
                                    ->first(); 
        
        if ($isAlreadySaved) {
            return response()->json([
                'error_message' => "There's already a room for that section in the current year."
            ], 409); 
        }
        
        $teacher = Teacher::where('id',$request->teacher_id)->first();

        $section = Section::create([
            'section_name' => $request->section_name,
            'teacher_id' => $request->teacher_id,
            'teacher_name' => $teacher->first_name . ' ' . $teacher->last_name,
            'year' => date("Y"),
            'semester' => $request->semester,
        ]);
        
        if (!$section) {
            return response()->json([
                'error_message' => "There's a problem creating the class."
            ], 500); // Internal Server Error
        }
        
        return response()->json([
            'message' => 'Class created successfully.',
            'section' => $section
        ], 201); // 201 Created
        

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $section = Section::where('id',$id)->first();

        if(!$section){
            return response()->json([
                'error_message' => "Connot find section"
            ],404);
        }

        return response()->json([
            'message' => "Section found succesfully!",
            'class' => $section
        ],302);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'section_name' => 'required|string',
            'teacher_id' => 'required|integer',
            'semester' => 'required|string'
        ]);
        
        $section = Section::where('id', $id)->first();  

        $section->update([
            'section_name' => $request->section_name,
            'teacher_id' => $request->teacher_id,
            'year' => date("Y"),
            'semester' => $request->semester,
        ]);
        
        if (!$section) {
            return response()->json([
                'error_message' => "There's a problem updating the class."
            ], 422);
        }
        
        return response()->json([
            'message' => 'Class created successfully.',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $section = Section::where('id',$id)->first();

        if(!$section){
            return response()->json([
                'error_message' => "Connot find class"
            ],404);
        }

        $section->delete();

        return response()->json([
            'message' => 'Class deleted successfully.'
        ],200);
    }


}
