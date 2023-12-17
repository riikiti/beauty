<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseUser;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CourseUserController extends Controller
{
    public function store(Request $request): View
    {
        $courses = Course::all();
        $teachers = Teacher::all();
        $validatedData = $request->validate([
            'course_id' => 'required',
        ]);

// Проверить существование комбинации user_id и course_id
        $exists = CourseUser::where('user_id', auth()->id())
            ->where('course_id', $validatedData['course_id'])
            ->exists();

        if (!$exists) {
            // Если комбинация не существует, добавить запись
            CourseUser::create([
                'user_id' => auth()->id(),
                'course_id' => $validatedData['course_id'],
            ]);
        } else {
            return view('welcome', ['teachers' => $teachers, 'courses' => $courses]);
        }


        return view('welcome', ['teachers' => $teachers, 'courses' => $courses]);
    }
}
