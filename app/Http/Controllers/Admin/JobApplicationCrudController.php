<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\JobApplicationRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Storage;

class JobApplicationCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\JobApplication::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/job-application');
        CRUD::setEntityNameStrings('job application', 'job applications');
    }

    // protected function setupListOperation()
    // {
    //     CRUD::column([
    //         'name' => 'job_listing_id',
    //         'label' => 'Job',
    //         'type' => 'select',
    //         'entity' => 'jobListing',
    //         'attribute' => 'title',
    //         'model' => \App\Models\JobListing::class,
    //     ]);
    //     CRUD::column('full_name');
    //     CRUD::column('email');
    //     CRUD::column('phone');
    //     CRUD::column([
    //         'name' => 'status',
    //         'type' => 'text',
    //         'label' => 'Status',
    //         'wrapper' => [
    //             'element' => 'span',
    //             'class' => function ($crud, $column, $entry) {
    //                 return match ($entry->status) {
    //                     'pending' => 'badge bg-warning',
    //                     'reviewed' => 'badge bg-info',
    //                     'shortlisted' => 'badge bg-success',
    //                     'rejected' => 'badge bg-danger',
    //                     default => 'badge bg-secondary',
    //                 };
    //             },
    //         ],
    //     ]);
    //     CRUD::column('created_at')->label('Applied At');
    // }

    protected function setupListOperation()
{
    $this->crud->setListView('admin.job_applications.list');

    $this->crud->query
        ->with(['jobListing'])
        ->orderBy('created_at', 'desc');
}

    protected function setupShowOperation()
    {
        CRUD::column([
            'name' => 'job_listing_id',
            'label' => 'Job',
            'type' => 'select',
            'entity' => 'jobListing',
            'attribute' => 'title',
        ]);
        CRUD::column('full_name');
        CRUD::column('email');
        CRUD::column('phone');
        CRUD::column([
            'name' => 'cover_letter',
            'type' => 'textarea',
            'label' => 'Cover Letter',
        ]);
        CRUD::column([
            'name' => 'resume_path',
            'label' => 'Resume',
            'type' => 'custom_html',
            'value' => function ($entry) {
                if ($entry->resume_path) {
                    $url = asset('storage/' . $entry->resume_path);
                    return '<a href="' . e($url) . '" target="_blank" class="btn btn-sm btn-primary">Download Resume</a>';
                }
                return '<span class="text-muted">No resume uploaded</span>';
            },
        ]);
        CRUD::column([
            'name' => 'cover_letter_path',
            'label' => 'Cover Letter File',
            'type' => 'custom_html',
            'value' => function ($entry) {
                if ($entry->cover_letter_path) {
                    $url = asset('storage/' . $entry->cover_letter_path);
                    return '<a href="' . e($url) . '" target="_blank" class="btn btn-sm btn-primary">Download Cover Letter</a>';
                }
                return '<span class="text-muted">No file uploaded</span>';
            },
        ]);
        CRUD::column('status');
        CRUD::column('created_at')->label('Applied At');
    }

    protected function setupUpdateOperation()
    {
        CRUD::setValidation(JobApplicationRequest::class);

        CRUD::addField([
            'name' => 'status',
            'type' => 'select_from_array',
            'label' => 'Application Status',
            'options' => [
                'pending' => 'Pending',
                'reviewed' => 'Reviewed',
                'shortlisted' => 'Shortlisted',
                'rejected' => 'Rejected',
            ],
        ]);
    }
}
