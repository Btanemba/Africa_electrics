<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CategoryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CategoryCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    //use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Category::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/category');
        CRUD::setEntityNameStrings('category', 'categories');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {

        //CRUD::setFromDb(); // set columns from db columns.

        $this->crud->setListView('admin.categories.list');
        $this->crud->query->withCount('products');

        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
         */
        CRUD::column('name')->label('Category Name');
        CRUD::column('slug')->label('Slug');
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CategoryRequest::class);
        //CRUD::setFromDb(); // set fields from db columns.
        CRUD::addField([
            'name' => 'name',
            'type' => 'text',
            'label' => 'Category Name',
            'attributes' => [
                'onkeyup' => 'generateSlug(this.value)'
            ]
        ]);

        CRUD::addField([
            'name' => 'slug',
            'type' => 'text',
            'label' => 'Slug',
            'attributes' => [
                'readonly' => 'readonly',
                'style' => 'background-color: #e9ecef; cursor: not-allowed;',
            ],
        ]);

        CRUD::addField([
            'name' => 'description',
            'type' => 'textarea',
            'label' => 'Description',
        ]);

        CRUD::addField([
        'name' => 'slug_script',
        'type' => 'custom_html',
        'value' => '
        <script>
            function generateSlug(value) {
                let slug = value
                    .toLowerCase()
                    .trim()
                    .replace(/[^a-z0-9]+/g, "-")
                    .replace(/^-+|-+$/g, "");

                let slugField = document.querySelector("input[name=\'slug\']");

                if (!slugField.dataset.manual) {
                    slugField.value = slug;
                }
            }

            document.addEventListener("DOMContentLoaded", function () {
                let slugField = document.querySelector("input[name=\'slug\']");

                slugField.addEventListener("input", function () {
                    this.dataset.manual = true;
                });
            });
        </script>
        ',
    ]);

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
