<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TeamMemberRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class TeamMemberCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\TeamMember::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/team-member');
        CRUD::setEntityNameStrings('team member', 'team members');
    }

    // protected function setupListOperation()
    // {
    //     CRUD::column('name');
    //     CRUD::column('role');
    //     CRUD::addColumn([
    //         'name'   => 'photo',
    //         'label'  => 'Photo',
    //         'type'   => 'closure',
    //         'function' => function ($entry) {
    //             if ($entry->photo) {
    //                 return '<img src="' . asset('storage/' . $entry->photo) . '" style="height:50px;width:50px;object-fit:cover;border-radius:4px;">';
    //             }
    //             return '-';
    //         },
    //         'escaped' => false,
    //     ]);
    //     CRUD::column('sort_order');
    //     CRUD::addColumn([
    //         'name'  => 'is_active',
    //         'label' => 'Active',
    //         'type'  => 'boolean',
    //     ]);

    //     CRUD::orderBy('sort_order', 'ASC');
    // }

    protected function setupListOperation()
{
    $this->crud->setListView('admin.team_members.list');

    $this->crud->query
        ->orderBy('sort_order', 'ASC');
}

    protected function setupCreateOperation()
    {
        CRUD::setValidation(TeamMemberRequest::class);

        CRUD::addField([
            'name'  => 'name',
            'type'  => 'text',
            'label' => 'Full Name',
        ]);

        CRUD::addField([
            'name'  => 'role',
            'type'  => 'text',
            'label' => 'Role / Title',
            'hint'  => 'e.g. Founder & CEO, Operations Manager',
        ]);

        CRUD::addField([
            'name'  => 'bio',
            'type'  => 'textarea',
            'label' => 'Short Bio',
        ]);

        CRUD::addField([
            'name'   => 'photo',
            'type'   => 'upload',
            'label'  => 'Photo',
            'upload' => true,
            'disk'   => 'public',
        ]);

        CRUD::addField([
            'name'    => 'sort_order',
            'type'    => 'number',
            'label'   => 'Display Order',
            'default' => 0,
        ]);

        CRUD::addField([
            'name'    => 'is_active',
            'type'    => 'checkbox',
            'label'   => 'Active (visible on website)',
            'default' => true,
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupReorderOperation()
    {
        CRUD::set('reorder.label', 'name');
        CRUD::set('reorder.max_level', 1);
    }
}
