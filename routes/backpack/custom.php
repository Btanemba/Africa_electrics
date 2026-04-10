<?php

use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\CRUD.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace' => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('category', 'CategoryCrudController');
    Route::crud('product', 'ProductCrudController');
    Route::get('product/{productId}/delete-image/{imageId}', 'ProductCrudController@deleteImage');
    Route::crud('job-listing', 'JobListingCrudController');
    Route::crud('job-application', 'JobApplicationCrudController');
    Route::crud('team-member', 'TeamMemberCrudController');
    Route::crud('user', 'UserCrudController');
    Route::crud('role', 'RoleCrudController');
    Route::crud('role-user', 'RoleUserCrudController');
    Route::crud('order', 'OrderCrudController');
    Route::crud('delivery', 'DeliveryCrudController');

    // Custom driver delivery interface
    Route::get('driver', 'DriverController@index')->name('driver.index');
    Route::get('driver/{order}', 'DriverController@show')->name('driver.show');
    Route::patch('driver/{order}/status', 'DriverController@updateStatus')->name('driver.updateStatus');
}); // this should be the absolute last line of this file

/**
 * DO NOT ADD ANYTHING HERE.
 */
