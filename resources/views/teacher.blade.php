<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    @vite([ 'resources/js/app.js','resources/scss/app.scss','resources/css/app.css'])
</head>
<body>
<header class="header">


    <a href="/">
        <x-application-logo class="w-20 h-20 fill-current text-gray-500"/>
    </a>

    <nav class="navigation">
        <ul>
            <li class="title title--4"><a href="{{ url('/contacts') }}">Контакты</a></li>

            <li class="title title--4"><a href="tel:+79208534927">+79208534927</a></li>
            <li class="title title--4"><a href="#">Telegram</a></li>
        </ul>
    </nav>
    @if (Route::has('login'))
        <div>
            @auth
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Hamburger -->
                <div class="-me-2 flex items-center sm:hidden">
                    <button @click="open = ! open"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden"
                                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">


                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <x-responsive-nav-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-responsive-nav-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-responsive-nav-link :href="route('logout')"
                                                       onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-responsive-nav-link>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}"
                   class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                    in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                       class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                @endif
            @endauth
        </div>
    @endif
</header>

<main class="main">
    <h2 class="title title--2">Преподователь {{$teacher->name}}</h2>
    <div class="course-page">
        <div class="course-card__img">
            <img src="http://127.0.0.1:8000/storage/{{$teacher->avatar}}" alt="{{$teacher->avatar}}">
        </div>
        <p>{{$teacher->description}}</p>
        <p>{{$teacher->direction}}</p>
    </div>
    <h2 class="title title--2">Курсы преподавателя {{$teacher->name}}</h2>
    <div class="course">
        @foreach($courses_array as $course)
            <div class="course-card">
                <div class="course-card__img">
                    <img src="http://127.0.0.1:8000/storage/{{$course['photo']}}" alt="{{$course['photo']}}">
                </div>
                <div class="course-card__info">
                    <div class="course-card__top">
                        <p class="course-card__price"> {{ $course['price'] }} руб.</p>
                        <p class="course-card__price"> {{ $course['duration'] }} дней(ня)</p>
                    </div>
                    <a href="{{ route('product.show', ['id' => $course['id']]) }}"
                       class="title title--3">{{ $course['title'] }}</a>
                    <p> {{ $course['description']}}</p>
                    @auth
                        <form method="post" action="">
                            <div class="course-card__submit">
                                <input type="hidden" name="course_id" value="{{$course['id']}}">
                                <button type="submit">Записаться</button>
                            </div>
                        </form>
                    @endauth
                </div>
            </div>
        @endforeach
    </div>


</main>
</body>
</html>
