<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CourseRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CourseCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CourseCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;


    public function setup()
    {
        CRUD::setModel(\App\Models\Course::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/course');
        CRUD::setEntityNameStrings('course', 'courses');
    }


    protected function setupListOperation()
    {
        $this->crud->column('id');
        $this->crud->column('title');
        $this->crud->addColumn([
            'name' => 'photo',
            'label' => 'Превью',
            'type' => 'image',
            'prefix' => '/storage/',
        ]);
        $this->crud->column('price');
        $this->crud->column('duration');

    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(CourseRequest::class);
        $this->crud->field('title');
        $this->crud->field('description');
        $this->crud->addField([
            'name' => 'photo',
            'label' => 'Логотип',
            'type' => 'upload',
            'withFiles' => true
        ]);
        $this->crud->field('price');
        $this->crud->field('duration');
    }


    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
