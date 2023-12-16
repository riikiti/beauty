<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GroupRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;


class GroupCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;


    public function setup()
    {
        CRUD::setModel(\App\Models\Group::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/group');
        CRUD::setEntityNameStrings('Группу', 'Группы');
    }


    protected function setupListOperation()
    {
        $this->crud->column('id');
        $this->crud->column('date_start')->label('Дата начала');
        $this->crud->column('date_start_time')->label('Время начала занятий');
        $this->crud->column('date_finish_time')->label('Время конца занятий');
        $this->crud->column('shift')->label('Смена');
    }

    protected function setupShowOperation()
    {
        $this->setupListOperation();
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(GroupRequest::class);
        $this->crud->field([   // DateTime
            'name'  => 'date_start',
            'label' => 'Дата начала',
            'type'  => 'datetime'
        ]);

        $this->crud->field([   // Time
            'name'  => 'date_start_time',
            'label' => 'Время начала занятий',
            'type'  => 'time'
        ]);


        $this->crud->field([   // Time
            'name'  => 'date_finish_time',
            'label' => 'Время конца занятий',
            'type'  => 'time'
        ]);

        $this->crud->field([
            'name'  => 'shift',
            'label' => 'Смена',
            'type'  => 'enum',
            'options' => [
                '1 смена' => '1 смена',
                '2 смена' => '2 смена',
                '3 смена' => '3 смена',
                'Группа вых. дня' => 'Группа вых. дня',
            ]
        ]);

    }


    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
