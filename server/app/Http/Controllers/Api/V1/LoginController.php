<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Mail\VerifyStudent;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str; 

class LoginController extends Controller
{

    protected static $emailVerification = VerifyStudent::class;

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ],[
            'email.required' => 'The email field is required.',
            'email.email' => 'Please provide a valid email address.',
            'password.required' => 'Password is required.',
        ]);

        // Check if the user is a student
        $student = Student::where('email', $request->email)->first();

        if ($student && Hash::check($request->password, $student->password)) {
            $token = $student->createToken('student-api-token', ['student'])->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'role' => 'student',
                'student' => $student,
                'token' => $token,
            ], 200);
        }

        // Check if the user is a teacher
        $teacher = Teacher::where('email', $request->email)->first();
        if ($teacher && Hash::check($request->password, $teacher->password)) {
            $token = $teacher->createToken('teacher-api-token', ['teacher'])->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'role' => 'teacher',
                'teacher' => $teacher,
                'token' => $token,
            ], 200);
        }

        // If neither login was successful, return a general error message
        return response()->json([
            'message' => 'Invalid email or password.',
        ], 401);
    }

    public function register(Request $request)
    {
        $request->validate([
            'school_id' => 'required|string',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $student = Student::where('school_id',$request->school_id)
                            ->where('email',$request->email)
                            ->first();
        
        if($student){
            return response()->json([
                'message' => 'Account already exist.'
            ],422);
        }

        $student = Student::create([
            'school_id' => $request->school_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => $request->password,
            'isEnrolled' => false
        ]);

        if(!$student){
            return response()->json([
                'message' => "There was an saving the account"
            ],500);
        }

        $token = Str::random(60);

        $student->verification_token = $token;
        $student->save();

        $subject = 'Email Verification';
        $name = ucfirst($student->first_name).' '.ucfirst($student->last_name);
        $link = env('APP_URL').'/api/v1/verify-email/'.$token;

        $this->sendMessage($subject,$name,$link,$student->email);

        $token = $student->createToken('student-api-token', ['student'])->plainTextToken;

        return response()->json([
            'message' => 'Account created successfully.',
            'role' => 'student',
            'student' => $student,
            'token' => $token,
        ], 201);

    }

    private function sendMessage($subject,$name,$link,$studentEmail)
    {
        Mail::to($studentEmail)
        ->send(new VerifyStudent($subject,$name,$link));
    }

    public function verify($token)
    {
        // Find the student by verification token
        $student = Student::where('verification_token', $token)->first();
    
        // Check if the student exists
        if (!$student) {
            return response()->json(['message' => 'Invalid verification token.'], 404);
        }
    
        // Update the student's enrollment status and clear the verification token
        $student->isEnrolled = true;
        $student->verification_token = null;
        $student->save();
    
        // Return a view with the student's name
        return view('TYpage', [
            'student' => $student->first_name . ' ' . $student->last_name
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logout successful',
        ], 200);
    }

}
