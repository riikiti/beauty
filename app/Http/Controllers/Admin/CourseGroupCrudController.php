<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CourseGroupRequest;
use App\Models\Course;
use App\Models\Group;
use App\Models\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;


class CourseGroupCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;


    public function setup()
    {
        CRUD::setModel(\App\Models\CourseGroup::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/course-group');
        CRUD::setEntityNameStrings('Курсы с группой', 'Курсы и группы');
    }


    protected function setupListOperation()
    {
        $this->crud->column('id')->label('id');
        $this->crud->addColumn([
            'name' => 'course',
            'label' => 'Курс',
            'type' => 'closure',
            'function' => function ($entry) {
                return $entry->course()->pluck('title')[0];
            }
        ]);

        $this->crud->addColumn([
            'name' => 'group',
            'label' => 'Группа',
            'type' => 'closure',
            'function' => function ($entry) {
                return $entry->info;
            }
        ]);
    }


    protected function setupCreateOperation()
    {
        CRUD::setValidation(CourseGroupRequest::class);
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

        $this->crud->addField([
            'label'     => "Группа",
            'type'      => 'select',
            'name'      => 'group_id',
            'entity'    => 'group',
            'model'     => Group::class,
            'attribute' => 'full_info',
            'options'   => (function ($query) {
                return $query->orderBy('shift', 'ASC')->get();
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
