<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;


class UserCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;


    public function setup()
    {
        CRUD::setModel(\App\Models\User::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user');
        CRUD::setEntityNameStrings('Пользователя', 'Пользователи');
    }


    protected function setupListOperation()
    {
        $this->crud->column('id')->label('id');
        $this->crud->column('name')->label('Имя');
        $this->crud->addColumn([
            'name' => 'avatar',
            'label' => 'Превью',
            'type' => 'image',
            'prefix' => '/storage/avatars/',
        ]);
        $this->crud->column('email')->label('Почта');
    }


    protected function setupShowOperation(){
        $this->setupListOperation();
    }
}
