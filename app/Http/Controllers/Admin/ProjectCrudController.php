<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class ProjectCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;

    public function setup(): void
    {
        CRUD::setModel(Project::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/project');
        CRUD::setEntityNameStrings('project', 'projects');
    }

    protected function setupListOperation(): void
    {
        $this->crud->query->ordered();

        CRUD::addColumn([
            'name' => 'title',
            'label' => 'Title',
            'type' => 'text',
        ]);

        CRUD::addColumn([
            'name' => 'category',
            'label' => 'Category',
            'type' => 'closure',
            'function' => static fn (Project $entry) => $entry->category_label,
        ]);

        CRUD::addColumn([
            'name' => 'summary',
            'label' => 'Summary',
            'type' => 'textarea',
            'limit' => 100,
        ]);

        CRUD::addColumn([
            'name' => 'location',
            'label' => 'Location',
            'type' => 'text',
        ]);

        CRUD::addColumn([
            'name' => 'project_year',
            'label' => 'Year',
            'type' => 'number',
        ]);

        CRUD::addColumn([
            'name' => 'sort_order',
            'label' => 'Order',
            'type' => 'number',
        ]);

        CRUD::addColumn([
            'name' => 'is_active',
            'label' => 'Active',
            'type' => 'boolean',
        ]);
    }

    protected function setupCreateOperation(): void
    {
        CRUD::setValidation(ProjectRequest::class);

        CRUD::addField([
            'name' => 'title',
            'label' => 'Project Title',
            'type' => 'text',
        ]);

        CRUD::addField([
            'name' => 'category',
            'label' => 'Category',
            'type' => 'select_from_array',
            'options' => Project::categoryOptions(),
            'allows_null' => false,
            'default' => 'solar',
        ]);

        CRUD::addField([
            'name' => 'summary',
            'label' => 'Summary',
            'type' => 'textarea',
            'attributes' => [
                'rows' => 4,
            ],
        ]);

        CRUD::addField([
            'name' => 'image',
            'label' => 'Project Image',
            'type' => 'upload',
            'upload' => true,
            'disk' => 'public',
        ]);

        CRUD::addField([
            'name' => 'location',
            'label' => 'Location',
            'type' => 'text',
        ]);

        CRUD::addField([
            'name' => 'project_year',
            'label' => 'Project Year',
            'type' => 'number',
            'attributes' => [
                'min' => 1900,
                'max' => ((int) date('Y')) + 1,
            ],
        ]);

        CRUD::addField([
            'name' => 'sort_order',
            'label' => 'Display Order',
            'type' => 'number',
            'default' => 0,
        ]);

        CRUD::addField([
            'name' => 'is_active',
            'label' => 'Active (visible on website)',
            'type' => 'checkbox',
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
