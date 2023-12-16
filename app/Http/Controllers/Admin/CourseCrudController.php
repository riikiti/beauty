<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CourseRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;


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
        CRUD::setEntityNameStrings('Курс', 'Курсы');
    }


    protected function setupListOperation()
    {
        $this->crud->column('id');
        $this->crud->column('title')->label('Название');
        $this->crud->addColumn([
            'name' => 'photo',
            'label' => 'Превью',
            'type' => 'image',
            'prefix' => '/storage/',
        ]);
        $this->crud->column('price')->label('Стоимость');
        $this->crud->column('duration')->label('Продолжительность');
        $this->crud->addColumn([
            'name' => 'in_slider',
            'label' => 'В слайдере',
            'type' => 'closure',
            'function' => function ($entry) {
                return $entry->getInSliderStatus();
            }
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(CourseRequest::class);
        $this->crud->field('title')->label('Название');
        $this->crud->field('description')->label('Описание');
        $this->crud->addField([
            'name' => 'photo',
            'label' => 'Логотип',
            'type' => 'upload',
            'withFiles' => true
        ]);
        $this->crud->field('price')->label('Стоимость');
        $this->crud->field([
            'name'  => 'duration',
            'label' => 'Продолжительность',
            'type'  => 'enum',
            'options' => [
                '15 дней' => '15 дней',
                '30 дней' => '30 дней',
                '60 дней' => '60 дней',
                '90 дней' => '90 дней',
            ]
        ]);
        $this->crud->field('in_slider')->label('В слайдере');
    }

    protected function setupShowOperation()
    {
        $this->setupListOperation();
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
