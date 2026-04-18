<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\JobListingRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class JobListingCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\JobListing::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/job-listing');
        CRUD::setEntityNameStrings('job listing', 'job listings');
    }

    // protected function setupListOperation()


    // {
    //     CRUD::column('title');
    //     CRUD::column([
    //         'name' => 'type',
    //         'type' => 'text',
    //         'label' => 'Type',
    //     ]);
    //     CRUD::column('location');
    //     CRUD::column([
    //         'name' => 'deadline',
    //         'type' => 'date',
    //         'label' => 'Deadline',
    //     ]);
    //     CRUD::column([
    //         'name' => 'is_active',
    //         'type' => 'boolean',
    //         'label' => 'Active',
    //     ]);
    //     CRUD::column([
    //         'name' => 'applications_count',
    //         'label' => 'Applications',
    //         'type' => 'text',
    //         'value' => function ($entry) {
    //             return $entry->applications()->count();
    //         },
    //     ]);
    // }

    protected function setupListOperation()
{
    $this->crud->setListView('admin.job_listings.list');

   
    $this->crud->query->withCount('applications')
        ->orderBy('created_at', 'desc');
}

    protected function setupCreateOperation()
    {
        CRUD::setValidation(JobListingRequest::class);

        CRUD::addField([
            'name' => 'title',
            'type' => 'text',
            'label' => 'Job Title',
        ]);

        CRUD::addField([
            'name' => 'location',
            'type' => 'text',
            'label' => 'Location',
            'hint' => 'e.g. Monrovia, Liberia',
        ]);

        CRUD::addField([
            'name' => 'type',
            'type' => 'select_from_array',
            'label' => 'Employment Type',
            'options' => [
                'full-time' => 'Full-Time',
                'part-time' => 'Part-Time',
                'contract' => 'Contract',
                'internship' => 'Internship',
            ],
            'default' => 'full-time',
        ]);

        CRUD::addField([
            'name' => 'description',
            'type' => 'textarea',
            'label' => 'Job Description',
        ]);

        CRUD::addField([
            'name' => 'requirements',
            'type' => 'textarea',
            'label' => 'Requirements',
            'hint' => 'One requirement per line',
        ]);

        CRUD::addField([
            'name' => 'responsibilities',
            'type' => 'textarea',
            'label' => 'Responsibilities',
            'hint' => 'One responsibility per line',
        ]);

        CRUD::addField([
            'name' => 'salary_range',
            'type' => 'text',
            'label' => 'Salary Range',
            'hint' => 'e.g. $500 - $1000/month (optional)',
        ]);

        CRUD::addField([
            'name' => 'deadline',
            'type' => 'date',
            'label' => 'Application Deadline',
        ]);

        CRUD::addField([
            'name' => 'is_active',
            'type' => 'checkbox',
            'label' => 'Active',
            'default' => true,
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
