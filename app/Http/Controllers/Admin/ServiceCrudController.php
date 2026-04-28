<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class ServiceCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;

    public function setup(): void
    {
        CRUD::setModel(Service::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/service');
        CRUD::setEntityNameStrings('service', 'services');
    }

    protected function setupListOperation(): void
    {
        $this->crud->setListView('admin.services.list');
        $this->crud->query->ordered();

        CRUD::column('title')->label('Service Title');
        CRUD::column('icon')->label('Icon');
    }

    protected function setupCreateOperation(): void
    {
        CRUD::setValidation(ServiceRequest::class);

        CRUD::addField([
            'name' => 'title',
            'type' => 'text',
            'label' => 'Title',
        ]);

        CRUD::addField([
            'name' => 'description',
            'type' => 'textarea',
            'label' => 'Description',
            'attributes' => [
                'rows' => 4,
            ],
        ]);

        CRUD::addField([
            'name' => 'icon',
            'type' => 'select_from_array',
            'label' => 'Icon',
            'options' => Service::iconOptions(),
            'allows_null' => false,
            'default' => 'switchboard',
        ]);

        CRUD::addField([
            'name' => 'sort_order',
            'type' => 'number',
            'label' => 'Display Order',
            'default' => 0,
        ]);

        CRUD::addField([
            'name' => 'is_active',
            'type' => 'checkbox',
            'label' => 'Active (visible on website)',
            'default' => true,
        ]);
    }

    protected function setupUpdateOperation(): void
    {
        $this->setupCreateOperation();
    }

    protected function setupDeleteOperation(): void
    {
        $this->crud->setOperationSetting('redirect_after_save', $this->crud->route);
    }

    protected function setupReorderOperation(): void
    {
        CRUD::set('reorder.label', 'title');
        CRUD::set('reorder.max_level', 1);
    }

    public function destroy($id)
    {
        $this->crud->delete($id);

        return redirect($this->crud->route);
    }
}