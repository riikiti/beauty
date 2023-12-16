{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}">Главная</a></li>

<x-backpack::menu-item title="Администраторы"  :link="backpack_url('admin')" />
<x-backpack::menu-item title="Пользователи"  :link="backpack_url('user')" />

<x-backpack::menu-item title="Курсы"  :link="backpack_url('course')" />
<x-backpack::menu-item title="Пользователи и курсы"  :link="backpack_url('course-user')" />
<x-backpack::menu-item title="Группы" :link="backpack_url('group')" />
<x-backpack::menu-item title="Учителя"  :link="backpack_url('teacher')" />
<x-backpack::menu-item title="Курсы и группы"  :link="backpack_url('course-group')" />
<x-backpack::menu-item title="Курсы и учителя" :link="backpack_url('course-teacher')" />
<x-backpack::menu-item title="Логи"  :link="backpack_url('logs')" />
