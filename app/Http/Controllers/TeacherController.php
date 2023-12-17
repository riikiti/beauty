<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseTeacher;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function show($id)
    {
        $teacher = Teacher::find($id);
        $teacher_courses = CourseTeacher::where('teacher_id', $teacher->id)->get();
        foreach ($teacher_courses as $teacher_course) {
            $course = $teacher_course->getCourse(); // вызов метода course()
            $courses_array[] = [
                'id' => $course->id,
                'title' => $course->title,
                'photo'=>$course->photo,
                'price'=>$course->price,
                'duration'=>$course->duration,
                'description'=>$course->description,
            ];

        }
        return view('teacher', ['teacher' => $teacher,'courses_array'=>$courses_array]);
    }
}
