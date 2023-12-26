<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseTeacher;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{

    public function filterByDirection(Request $request)
    {
        $courses = Course::paginate(2);
        if (empty($request->input('direction'))) {
            $teachers = Teacher::all();
        }
        else{
            $teachers = Teacher::where('direction', $request->input('direction'))->get();
        }

        $teachers_for_filter = Teacher::all();
        $teacher_on_courses = [];
        $directions = [];

        foreach ($teachers_for_filter as $teacher) {
            $direction = $teacher->direction;
            if (!in_array($direction, $directions)) {
                $directions[] = $direction;
                $teacher_on_courses[] = [
                    'direction' => $direction,
                ];
            }
        }


        return view('welcome', ['teachers' => $teachers, 'courses' => $courses, 'teacher_on_courses' => $teacher_on_courses]);
    }

    public function show($id)
    {
        $courses_array = [];
        $teacher = Teacher::find($id);
        $teacher_courses = CourseTeacher::where('teacher_id', $teacher->id)->get();
        foreach ($teacher_courses as $teacher_course) {
            $course = $teacher_course->getCourse(); // вызов метода course()
            $courses_array[] = [
                'id' => $course->id,
                'title' => $course->title,
                'photo' => $course->photo,
                'price' => $course->price,
                'duration' => $course->duration,
                'description' => $course->description,
            ];

        }
        return view('teacher', ['teacher' => $teacher, 'courses_array' => $courses_array]);
    }
}
