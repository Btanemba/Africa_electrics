<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RoleUserRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class RoleUserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RoleUserCrudController extends CrudController
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
        CRUD::setModel(\App\Models\RoleUser::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/role-user');
        CRUD::setEntityNameStrings('role user', 'role users');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    // protected function setupListOperation()
    // {
    //     CRUD::column('user_id')->type('select')->entity('user')->model('App\Models\User')->attribute('full_name')->label('User');
    //     CRUD::column('role_id')->type('select')->entity('role')->model('App\Models\Role')->attribute('name')->label('Role');
    // }

    protected function setupListOperation()
{
    $this->crud->setListView('admin.role_users.list');

    $query = $this->crud->query;

    // Eager load relationships
    $query->with(['user', 'role']);

    // Search (user name OR role name)
    if ($search = request('search')) {
        $query->whereHas('user', function ($q) use ($search) {
            $q->where('first_name', 'like', "%$search%")
              ->orWhere('last_name', 'like', "%$search%");
        })->orWhereHas('role', function ($q) use ($search) {
            $q->where('name', 'like', "%$search%");
        });
    }

    $query->orderBy('id', 'desc');
}

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(RoleUserRequest::class);
        CRUD::field('user_id')->type('select')->entity('user')->model('App\Models\User')->attribute('full_name');
        // CRUD::field('role_id');
        CRUD::field('role_id')
            ->type('select')
            ->entity('role')
            ->model(\App\Models\Role::class)
            ->attribute('name');


        /**
         * Fields can be defined using the fluent syntax:
         * - CRUD::field('price')->type('number');
         */
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
