<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Logs;
use App\Models\Teacher;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): View
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        $courses = Course::paginate(2);
        $teachers = Teacher::all();
        Logs::create([
            'content' => 'Пользователь зарегестрировался',
            'user_id' => $user->id
        ]);
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
}
