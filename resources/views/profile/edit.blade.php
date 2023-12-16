<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">


            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <div class="profile-top">
                    <h3>{{ $user->email }}</h3>
                    <img src="http://127.0.0.1:8000/storage/avatars/{{$user->avatar}}" alt="{{$user->avatar}}">
                    <h2 class="title title--2">
                        Ваши курсы
                    </h2>

                    @foreach(App\Models\CourseUser::where('user_id', auth()->id())->get() as $item)
                        <ul>
                            <li> {{ $item->getProfileInfoStatus() }}</li>
                        </ul>
                    @endforeach
                </div>

            </div>


            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
