<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\ProjectImage;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Storage;

class ProjectCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }
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
        $this->crud->setListView('admin.projects.list');
        $this->crud->query->with('images')->ordered();

        CRUD::column('title')->label('Project Title');
        CRUD::addColumn([
            'name' => 'category',
            'label' => 'Category',
            'type' => 'closure',
            'function' => static fn (Project $entry) => $entry->category_label,
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
            'name' => 'project_images',
            'label' => 'Project Images',
            'type' => 'upload_multiple',
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

        $project = $this->crud->getCurrentEntry();

        if (! $project) {
            return;
        }

        $project->loadMissing('images');

        if ($project->images->isEmpty()) {
            return;
        }

        $html = '<label>Current Images</label><div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:15px;">';

        foreach ($project->images as $image) {
            $url = asset('storage/' . $image->image_path);
            $html .= '<div style="position:relative;">';
            $html .= '<img src="' . e($url) . '" style="width:120px;height:120px;object-fit:cover;border-radius:5px;border:1px solid #ddd;">';
            $html .= '<a href="' . e(url($this->crud->getRoute() . '/' . $project->id . '/delete-image/' . $image->id)) . '" style="position:absolute;top:-8px;right:-8px;background:red;color:white;border-radius:50%;width:22px;height:22px;text-align:center;line-height:22px;text-decoration:none;font-size:14px;" onclick="return confirm(&#39;Delete this image?&#39;)">&times;</a>';
            $html .= '</div>';
        }

        $html .= '</div>';

        CRUD::addField([
            'name' => 'current_images_display',
            'type' => 'custom_html',
            'value' => $html,
        ])->beforeField('project_images');
    }

    public function store()
    {
        $response = $this->traitStore();

        $this->saveImages($this->crud->entry);

        return $response;
    }

    public function update()
    {
        $response = $this->traitUpdate();

        $this->saveImages($this->crud->entry);

        return $response;
    }

    public function deleteImage($projectId, $imageId)
    {
        $image = ProjectImage::where('id', $imageId)
            ->where('project_id', $projectId)
            ->firstOrFail();

        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return redirect()->back();
    }

    private function saveImages(Project $project): void
    {
        $files = request()->file('project_images');

        if (! $files) {
            return;
        }

        $sortOrder = (int) $project->images()->max('sort_order');

        foreach ($files as $file) {
            if (! $file) {
                continue;
            }

            $sortOrder++;

            $path = $file->store('projects', 'public');

            ProjectImage::create([
                'project_id' => $project->id,
                'image_path' => $path,
                'sort_order' => $sortOrder,
            ]);
        }
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
        $project = Project::with('images')->findOrFail($id);

        foreach ($project->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        if ($project->image) {
            Storage::disk('public')->delete($project->image);
        }

        $this->crud->delete($id);

        return redirect($this->crud->route);
    }
}
