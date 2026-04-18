<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use App\Models\ProductImage;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Storage;

/**
 * Class ProductCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProductCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Product::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/product');
        CRUD::setEntityNameStrings('product', 'products');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {

    $this->crud->setListView('admin.products.list');

    // IMPORTANT: eager load relationships
    $this->crud->query->with(['category', 'images']);
        CRUD::column('name');
        CRUD::column('slug');
        CRUD::column([
            'name' => 'category_id',
            'label' => 'Category',
            'type' => 'select',
            'entity' => 'category',
            'attribute' => 'name',
            'model' => \App\Models\Category::class,
        ]);
        CRUD::column([
            'name' => 'price',
            'type' => 'number',
            'prefix' => '$',
            'decimals' => 2,
        ]);
        CRUD::column('stock_quantity');
        CRUD::column('sku');
        CRUD::column([
            'name' => 'status',
            'type' => 'boolean',
            'label' => 'Active',
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ProductRequest::class);

        CRUD::addField([
            'name' => 'name',
            'type' => 'text',
            'label' => 'Product Name',
            'attributes' => [
                'onkeyup' => 'generateSlug(this.value)',
            ],
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
            'name' => 'category_id',
            'label' => 'Category',
            'type' => 'select',
            'entity' => 'category',
            'attribute' => 'name',
            'model' => \App\Models\Category::class,
        ]);

        CRUD::addField([
            'name' => 'description',
            'type' => 'textarea',
            'label' => 'Description',
        ]);

        CRUD::addField([
            'name' => 'price',
            'type' => 'number',
            'label' => 'Price',
            'prefix' => '$',
            'attributes' => [
                'step' => '0.01',
            ],
        ]);

        CRUD::addField([
            'name' => 'stock_quantity',
            'type' => 'number',
            'label' => 'Stock Quantity',
        ]);

        CRUD::addField([
            'name' => 'sku',
            'type' => 'text',
            'label' => 'SKU',
        ]);

        CRUD::addField([
            'name' => 'status',
            'type' => 'checkbox',
            'label' => 'Active',
            'default' => true,
        ]);

    CRUD::addField([
        'name' => 'product_images',
        'label' => 'Upload Images',
        'type' => 'upload_multiple',
        'upload' => true,
        'disk' => 'public',
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

        $product = $this->crud->getCurrentEntry();
        if ($product && $product->images->count()) {
            $html = '<label>Current Images</label><div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:15px;">';
            foreach ($product->images as $image) {
                $url = asset('storage/' . $image->image_path);
                $html .= '<div style="position:relative;">';
                $html .= '<img src="' . e($url) . '" style="width:120px;height:120px;object-fit:cover;border-radius:5px;border:1px solid #ddd;">';
                $html .= '<a href="' . e(url($this->crud->getRoute() . '/' . $product->id . '/delete-image/' . $image->id)) . '" style="position:absolute;top:-8px;right:-8px;background:red;color:white;border-radius:50%;width:22px;height:22px;text-align:center;line-height:22px;text-decoration:none;font-size:14px;" onclick="return confirm(&#39;Delete this image?&#39;)">&times;</a>';
                $html .= '</div>';
            }
            $html .= '</div>';

            CRUD::addField([
                'name' => 'current_images_display',
                'type' => 'custom_html',
                'value' => $html,
            ])->beforeField('product_images');
        }
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

    public function deleteImage($productId, $imageId)
    {
        $image = ProductImage::where('id', $imageId)
            ->where('product_id', $productId)
            ->firstOrFail();

        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return redirect()->back();
    }

    private function saveImages($product)
    {
        $files = request()->file('product_images');

        if ($files) {
            foreach ($files as $file) {
                $path = $file->store('product_images', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                ]);
            }
        }
    }

    protected function setupDeleteOperation()
    {
        $this->crud->setOperationSetting('redirect_after_save', $this->crud->route);
    }

    public function destroy($id)
    {
        $this->crud->delete($id);
        return redirect($this->crud->route);
    }
}
