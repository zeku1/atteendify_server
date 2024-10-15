<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\ClassSession;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ClassParticipant;
use App\Models\Section;
use App\Models\SessionParticipant;
use App\Models\Student;

class ClassSessionController extends Controller
{
    /**
     * Student joins mannually
     */
    public function joinSession(Request $request)
    {
        $request->validate([
            'session_id' => 'required|integer',
            'student_id' => 'required|integer',
            'time' => 'required|date_format:H:i:s'
        ]);

        $session = ClassSession::where('id',$request->session_id)
                                ->whereNull('end_time')
                                ->first();
        if(!$session){
            return response()->json([
                'error_message' => 'The session has already ended'
            ],422);
        }

        $student = Student::where('id',$request->student_id)
                            ->first();

        if(!$student){
            return response()->json([
                'error_message' => "There's no student with your cerendentials"
            ],400);
        }

        $enrolled = ClassParticipant::where('section_id',$session->section_id)
                                    ->where('student_id',$request->student_id)
                                    ->first();

        if(!$enrolled){
            return response()->json([
                'error_message' => "Student not enrolled!"
            ],401);
        }

        $sessionParticipant = SessionParticipant::where('class_session_id', $session->id)
                                                ->where('student_id', $student->id)
                                                ->first();
        if ($sessionParticipant) {
            return response()->json([
            'error_message' => 'Your attendance is already recorded'
            ], 400);
        }

        SessionParticipant::create([
            'class_session_id' => $request->session_id,
            'student_id' => $student->id,
            'time' => $request->time,
        ]);

        return response()->json([
            'message' => "Your attendance is recorded."
        ],201);
    }

    /**
     * Display a listing of the resource.
     */
    public function addStudent(Request $request)
    {
        $request->validate([
            'session_id' => 'required|integer',
            'student_school_id' => 'required|string',
            'time' => 'required|date_format:H:i:s'
        ]);
        $session = ClassSession::where('id',$request->session_id)
                ->whereNull('end_time')
                ->first();
        if(!$session){
            return response()->json([
            'error_message' => 'The session has already ended'
            ],422);
        }

        $student = Student::where('school_id',$request->student_school_id)
                            ->first();
        if(!$student){
            return response()->json([
                'error_message' => "There's no student with that cerendentials"
            ],400);
        }

        $sessionParticipant = SessionParticipant::where('class_session_id', $session->id)
                                                ->where('student_id', $student->id)
                                                ->first();
        if ($sessionParticipant) {
            return response()->json([
            'error_message' => $student->last_name.' attendance is already recorded'
            ], 400);
        }

        SessionParticipant::create([
            'class_session_id' => $request->session_id,
            'student_id' => $student->id,
            'time' => $request->time
        ]);

        return response()->json([
            'message' => $student->last_name.' attendance successfully recorded'
        ],201);
    }

    /**
     * Start a class session
     */
    public function start($id)
    {
    
        $section = Section::where('id', $id)->first();
        if (!$section) {
            return response()->json([
                'error_message' => "Class does not exist"
            ], 404);
        }

        $session = ClassSession::where('section_id', $id)
                                ->whereNull('end_time')
                                ->first();
        
        if ($session) {
            return response()->json([
                'error_message' => "An active session already exists"
            ], 400);
        }
    
        $classSession = ClassSession::create([
            'section_id' => $section->id,
            'date' => date('Y-m-d'),
            'start_time' => date('H:i:s') // 24-hour format
        ]);
    
        if (!$classSession) {
            return response()->json([
                'error_message' => "There was an error creating your session."
            ], 500);
        }
    
        return response()->json([
            'message' => 'The session has started',
            'session' => $classSession->load('students')
        ], 201);
    }

    /**
     * End a class session
     */
    public function end(Request $request)
    {
        $request->validate([
            'section_id' => 'required'
        ]);
        
        $section = Section::where('id', $request->section_id)->first();
        if (!$section) {
            return response()->json([
                'error_message' => "Class does not exist"
            ], 404);
        }

        $session = ClassSession::where('section_id', $request->section_id)
                                ->whereNull('end_time')
                                ->first();

        if (!$session) {
            return response()->json([
                'error_message' => "No active session found."
            ], 404);
        }

       
        $session->update([
            'end_time' => date('H:i:s')
        ]);

        return response()->json([
            'message' => 'The session ended successfully',
            'session' => $session->load('students')
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassSession $classSession)
    {
        return response()->json([
            'message' => 'Success!',
            'session' => $classSession->load('students')
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassSession $classSession)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClassSession $classSession)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassSession $classSession)
    {
        //
    }
}
