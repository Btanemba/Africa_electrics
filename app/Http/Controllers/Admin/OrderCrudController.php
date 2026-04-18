<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OrderRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class OrderCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;



    public function setup()
    {
        CRUD::setModel(\App\Models\Order::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/order');
        CRUD::setEntityNameStrings('order', 'orders');
    }

    protected function setupListOperation()
    {
        $this->crud->setListView('admin.orders.list');

        $this->crud->query->with(['assignedTo', 'items'])
            ->orderBy('created_at', 'desc');
    }

    /**
     * Delete an order - only admins can delete
     */


    protected function setupUpdateOperation()
    {
        CRUD::field('status')->type('select_from_array')->options([
            'pending' => 'Pending',
            'confirmed' => 'Confirmed',
            'shipped' => 'Shipped',
            'delivered' => 'Delivered',
            'cancelled' => 'Cancelled',
        ]);
        CRUD::field('assigned_to')->type('select')->label('Assign Driver')->entity('assignedTo')->attribute('full_name')->model('App\Models\User');
    }

    protected function setupShowOperation()
    {
        CRUD::column('order_number')->label('Order #');
        CRUD::column('customer_name');
        CRUD::column('customer_email');
        CRUD::column('customer_phone');
        CRUD::column('address');
        CRUD::column('city');
        CRUD::column('state');
        CRUD::column('postal_code');
        CRUD::column('country');
        CRUD::column('notes');
        CRUD::column('status');
        CRUD::column('assigned_to')->type('select')->entity('assignedTo')->attribute('full_name')->model('App\Models\User')->label('Assigned Driver');
        CRUD::column('total_amount')->type('number')->prefix('$')->decimals(2);
        CRUD::column('created_at')->label('Ordered At');

        CRUD::column('order_items')->type('model_function')->function_name('getItemsHtml')->label('Order Items')->escaped(false)->limit(10000);
    }

    
}
