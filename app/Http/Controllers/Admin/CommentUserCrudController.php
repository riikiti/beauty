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
class CommentUserCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Comment::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/comment');
        CRUD::setEntityNameStrings('', 'Комментарии');
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
            'name' => 'body',
            'label' => 'Комментатрий',
        ]);
    }





    protected function setupShowOperation(){
        $this->setupListOperation();
    }
}
