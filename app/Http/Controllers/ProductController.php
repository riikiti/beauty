<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseGroup;
use App\Models\CourseTeacher;

class ProductController extends Controller
{
    public function show($id)
    {
        $course = Course::find($id);
        $group_array = [];
        $teacher_courses_array = [];
        $group_courses = CourseGroup::where('course_id', $course->id)->get();
        foreach ($group_courses as $group_course) {
            $group = $group_course->getGroup();
            $group_array[] = [
                'date_start' => $group->date_start,
                'date_start_time' => $group->date_start_time,
                'date_finish_time' => $group->date_finish_time,
                'shift' => $group->shift,
            ];
        }

        $teacher_courses = CourseTeacher::where('course_id', $course->id)->get();
        foreach ($teacher_courses as $teacher_course) {
            $teacher = $teacher_course->getTeacher();
            $teacher_courses_array[] = [
                'id' => $teacher->id,
                'name' => $teacher->name,
                'avatar' => $teacher->avatar,
                'direction' => $teacher->direction,
                'description' => $teacher->descriptio,
            ];
        }
        return view('course', ['course' => $course, 'group_array' => $group_array, 'teacher_on_courses' => $teacher_courses_array]);
    }
}
