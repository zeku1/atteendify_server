<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validate email and password fields
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        // Check if the user is a student
        $student = Student::where('email', $request->email)->with('sections')->first();
       
        if ($student && Hash::check($request->password, $student->password)) {
            $token = $student->createToken('student-api-token', ['student'])->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'role' => 'student',
                'student' => $student,
                'token' => $token,
            ],200);
        }

        // Check if the user is a teacher
        $teacher = Teacher::where('email', $request->email)->with('sections')->first();
        if ($teacher && Hash::check($request->password, $teacher->password)) {
            $token = $teacher->createToken('teacher-api-token', ['teacher'])->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'role' => 'teacher',
                'teacher' => $teacher,
                'token' => $token,
            ],200);
        }

        // Invalid credentials
        return response()->json([
            'error_message' => 'Invalid email or password.'
        ], 401);
    }

    public function register(Request $request)
    {

            $request->validate([
            'school_id' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'email',
            'password' => 'required|string',
        ]);

        $student = Student::where('school_id',$request->school_id)
                            ->where('email',$request->email)
                            ->first();
        
        if($student){
            return response()->json([
                'error_message' => 'Account already exist.'
            ],422);
        }

        $student = Student::create([
            'school_id' => $request->school_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
            'isEnrolled' => true
        ]);

        if(!$student){
            return response()->json([
                'error_message' => "There was an saving the account"
            ],500);
        }

        

        $token = $student->createToken('student-api-token', ['student'])->plainTextToken;

        return response()->json([
            'message' => 'Account created successfully.',
            'role' => 'student',
            'student' => $student,
            'token' => $token,
        ], 201);

    }


}
