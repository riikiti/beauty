<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CourseTeacherRequest;
use App\Models\Course;
use App\Models\Group;
use App\Models\Teacher;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;


class CourseTeacherCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;


    public function setup()
    {
        CRUD::setModel(\App\Models\CourseTeacher::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/course-teacher');
        CRUD::setEntityNameStrings('Учителя для курса', 'Учителя для курсов');
    }

    protected function setupListOperation()
    {
        $this->crud->column('id')->label('id');
        $this->crud->addColumn([
            'label' => 'Курс',
            'name' => 'course',
            'type' => 'closure',
            'function' => function ($entry) {
                return $entry->course()->pluck('title')[0];
            }
        ]);

        $this->crud->addColumn([
            'label' => 'Преподователь',
            'name' => 'teacher',
            'type' => 'closure',
            'function' => function ($entry) {
                return $entry->teacher()->pluck('name')[0];
            }
        ]);
    }


    protected function setupCreateOperation()
    {
        CRUD::setValidation(CourseTeacherRequest::class);
        $this->crud->addField([
            'label'     => "Преподователь",
            'type'      => 'select',
            'name'      => 'teacher_id',
            'entity'    => 'teacher',
            'model'     => Teacher::class,
            'attribute' => 'name',
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);

        $this->crud->addField([
            'label'     => "Курс",
            'type'      => 'select',
            'name'      => 'course_id',
            'entity'    => 'course',
            'model'     => Course::class,
            'attribute' => 'title',
            'options'   => (function ($query) {
                return $query->orderBy('title', 'ASC')->get();
            }),
        ]);
    }
    protected function setupShowOperation(){
        $this->setupListOperation();
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
