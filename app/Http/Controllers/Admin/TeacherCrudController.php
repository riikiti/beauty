<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TeacherRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;


class TeacherCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;


    public function setup()
    {
        CRUD::setModel(\App\Models\Teacher::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/teacher');
        CRUD::setEntityNameStrings('Преподователя', 'Преподователи');
    }

    protected function setupListOperation()
    {
        $this->crud->column('id');
        $this->crud->column('name')->label('Имя');
        $this->crud->addColumn([
            'name' => 'avatar',
            'label' => 'Аватар',
            'type' => 'image',
            'prefix' => '/storage/',
        ]);
        $this->crud->column('description')->label('Описание');
        $this->crud->column('direction')->label('Направление');


    }

    protected function setupShowOperation(){
        $this->setupListOperation();
    }
    protected function setupCreateOperation()
    {
        CRUD::setValidation(TeacherRequest::class);
        $this->crud->field('name')->label('Имя');
        $this->crud->field('description')->label('Описание');
        $this->crud->addField([
            'name' => 'avatar',
            'label' => 'Аватар',
            'type' => 'upload',
            'withFiles' => true
        ]);
        $this->crud->field([
            'name'  => 'direction',
            'label' => 'Направление',
            'type'  => 'enum',
            'options' => [
                'Барбер' => 'Барбер',
                'Шугаринг' => 'Шугаринг',
                'Визажист' => 'Визажист',
                'Парикмахер-универсал' => 'Парикмахер-универсал',
                'Наращивание волос' => 'Наращивание волос',
                'Плетение кос' => 'Плетение кос',
                'Укладка волос, причёски' => 'Укладка волос, причёски',
                'Бровист' => 'Бровист',
                'Дизайны ногтей' => 'Дизайны ногтей',
                'Анатомия старения +скульптурно-буккальный массаж' => 'Анатомия старения +скульптурно-буккальный массаж',
            ]
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
