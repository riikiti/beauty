<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseUser;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        $teachers = Teacher::all();
        return view('welcome', ['teachers' => $teachers, 'courses' => $courses]);
    }

    public function store(Request $request): View
    {
        CourseUser::create([
            'user_id' => auth()->id(),
            'course_id' => $_POST['course_id'],
            'approved' => false,
        ]);
        $courses = Course::all();
        $teacher = Teacher::all();
        return view('welcome', ['teacher' => $teacher, 'courses' => $courses]);

    }
}
