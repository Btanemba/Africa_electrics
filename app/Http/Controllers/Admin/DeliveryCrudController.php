<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DeliveryRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class DeliveryCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Order::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/delivery');
        CRUD::setEntityNameStrings('delivery', 'my deliveries');

        // Only show orders assigned to the logged-in driver
        CRUD::addClause('where', 'assigned_to', backpack_user()->id);
    }

    protected function setupListOperation()
    {
        CRUD::column('order_number')->label('Order #')->priority(1);
        CRUD::column('customer_name')->priority(2);
        CRUD::column('customer_phone')->priority(3)->label('Phone');
        CRUD::column('delivery_address')->type('model_function')->function_name('getDeliveryAddressShort')->label('Delivery To')->priority(4)->limit(50);
        CRUD::column('status')->type('select_from_array')->options([
            'pending' => 'Pending',
            'confirmed' => 'Confirmed',
            'shipped' => 'Shipped',
            'delivered' => 'Delivered',
            'cancelled' => 'Cancelled',
        ])->priority(1);
        CRUD::column('total_amount')->type('number')->prefix('$')->decimals(2)->priority(5);

        CRUD::orderBy('created_at', 'desc');
    }

    protected function setupUpdateOperation()
    {
        CRUD::field('status')->type('select_from_array')->options([
            'shipped' => 'Shipped (Picked Up)',
            'delivered' => 'Delivered',
        ]);
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
        CRUD::column('total_amount')->type('number')->prefix('$')->decimals(2);
        CRUD::column('order_items')->type('model_function')->function_name('getItemsHtml')->label('Order Items')->escaped(false)->limit(10000);
    }
}
