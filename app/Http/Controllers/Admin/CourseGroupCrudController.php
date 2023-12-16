<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CourseGroupRequest;
use App\Models\Course;
use App\Models\Group;
use App\Models\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CourseGroupCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CourseGroupCrudController extends CrudController
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
        CRUD::setModel(\App\Models\CourseGroup::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/course-group');
        CRUD::setEntityNameStrings('course group', 'course groups');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->column('id')->label('id');
        $this->crud->addColumn([
            'name' => 'course',
            'label' => 'course',
            'type' => 'closure',
            'function' => function ($entry) {
                return $entry->course()->pluck('title');
            }
        ]);

        $this->crud->addColumn([
            'name' => 'group',
            'label' => 'group',
            'type' => 'closure',
            'function' => function ($entry) {
                return $entry->group()->pluck('shift');
            }
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CourseGroupRequest::class);
        $this->crud->addField([
            'label'     => "course",
            'type'      => 'select',
            'name'      => 'id_course',
            'entity'    => 'course',
            'model'     => Course::class,
            'attribute' => 'title',
            'options'   => (function ($query) {
                return $query->orderBy('title', 'ASC')->get();
            }),
        ]);

        $this->crud->addField([
            'label'     => "group",
            'type'      => 'select',
            'name'      => 'id_group',
            'entity'    => 'course',
            'model'     => Group::class,
            'attribute' => 'shift',
            'options'   => (function ($query) {
                return $query->orderBy('shift', 'ASC')->get();
            }),
        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
