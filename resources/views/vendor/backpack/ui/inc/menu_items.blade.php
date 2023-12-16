{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<x-backpack::menu-item title="Admins" icon="la la-question" :link="backpack_url('admin')" />
<x-backpack::menu-item title="Users" icon="la la-question" :link="backpack_url('user')" />

<x-backpack::menu-item title="Courses" icon="la la-question" :link="backpack_url('course')" />
<x-backpack::menu-item title="Course users" icon="la la-question" :link="backpack_url('course-user')" />
<x-backpack::menu-item title="Groups" icon="la la-question" :link="backpack_url('group')" />
<x-backpack::menu-item title="Teachers" icon="la la-question" :link="backpack_url('teacher')" />
<x-backpack::menu-item title="Course groups" icon="la la-question" :link="backpack_url('course-group')" />
<x-backpack::menu-item title="Course teachers" icon="la la-question" :link="backpack_url('course-teacher')" />
<x-backpack::menu-item title="Logs" icon="la la-question" :link="backpack_url('logs')" />