<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Course;
use App\Models\Logs;
use App\Models\Teacher;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): View
    {
        $request->authenticate();

        $request->session()->regenerate();


        $id = auth()->user()->getAuthIdentifier();

        Logs::create([
            'content'=>'Пользователь авторизовался',
            'user_id'=>$id
        ]);

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

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
