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
        $courses = Course::paginate(2);
        $teachers = Teacher::all();
        $teacher_on_courses = [];
        $directions = [];

        foreach ($teachers as $teacher) {
            $direction = $teacher->direction;
            if (!in_array($direction, $directions)) {
                $directions[] = $direction;
                $teacher_on_courses[] = [
                    'direction' => $direction,
                ];
            }
        }
        return view('welcome', ['teachers' => $teachers, 'courses' => $courses,'teacher_on_courses'=>$teacher_on_courses]);
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
