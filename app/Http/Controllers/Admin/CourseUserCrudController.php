<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CourseUserRequest;
use App\Models\Course;
use App\Models\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CourseUserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CourseUserCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\CourseUser::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/course-user');
        CRUD::setEntityNameStrings('Пользователя на курс', 'Пользователи и их курсы');
    }

    protected function setupListOperation()
    {
        $this->crud->column('id')->label('id');
        $this->crud->addColumn([
            'name' => 'id_user',
            'label' => 'Пользователи',
            'type' => 'closure',
            'function' => function ($entry) {
                return $entry->user()->pluck('name')[0];
            }
        ]);

        $this->crud->addColumn([
            'name' => 'course',
            'label' => 'Курсы',
            'type' => 'closure',
            'function' => function ($entry) {
                return $entry->course()->pluck('title')[0];
            }
        ]);
        $this->crud->addColumn([
            'name' => 'approved',
            'label' => 'Статус подтверждения',
            'type' => 'closure',
            'function' => function ($entry) {
                return $entry->getpApprovedStatusStatus();
            }
        ]);
    }


    protected function setupCreateOperation()
    {
        CRUD::setValidation(CourseUserRequest::class);
        $this->crud->addField([
            'label'     => "Пользователь",
            'type'      => 'select',
            'name'      => 'user_id',
            'entity'    => 'user',
            'model'     => User::class,
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
        $this->crud->field('approved')->label('Подтверждено');
    }


    protected function setupShowOperation(){
        $this->setupListOperation();
    }
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
