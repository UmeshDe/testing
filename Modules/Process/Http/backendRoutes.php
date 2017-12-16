<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/process'], function (Router $router) {
    $router->bind('product', function ($id) {
        return app('Modules\Process\Repositories\ProductRepository')->find($id);
    });
    $router->get('products', [
        'as' => 'admin.process.product.index',
        'uses' => 'ProductController@index',
        'middleware' => 'can:process.products.index'
    ]);
    $router->get('products/create', [
        'as' => 'admin.process.product.create',
        'uses' => 'ProductController@create',
        'middleware' => 'can:process.products.create'
    ]);
    $router->get('products/packing', [
        'as' => 'admin.process.product.packing',
        'uses' => 'ProductController@packingcreate',
        'middleware' => 'can:process.products.create'
    ]);
    $router->get('products/packingindex', [
        'as' => 'admin.process.product.packingindex',
        'uses' => 'ProductController@packingindex',
        'middleware' => 'can:process.products.index'
    ]);
    $router->post('products', [
        'as' => 'admin.process.product.store',
        'uses' => 'ProductController@store',
        'middleware' => 'can:process.products.create'
    ]);
    $router->get('products/{product}/edit', [
        'as' => 'admin.process.product.edit',
        'uses' => 'ProductController@edit',
        'middleware' => 'can:process.products.edit'
    ]);
    $router->put('products/{product}', [
        'as' => 'admin.process.product.update',
        'uses' => 'ProductController@update',
        'middleware' => 'can:process.products.edit'
    ]);
    $router->delete('products/{product}', [
        'as' => 'admin.process.product.destroy',
        'uses' => 'ProductController@destroy',
        'middleware' => 'can:process.products.destroy'
    ]);
    $router->bind('carton', function ($id) {
        return app('Modules\Process\Repositories\CartonRepository')->find($id);
    });
    $router->get('cartons', [
        'as' => 'admin.process.carton.index',
        'uses' => 'CartonController@index',
        'middleware' => 'can:process.cartons.index'
    ]);
    $router->get('cartons/create', [
        'as' => 'admin.process.carton.create',
        'uses' => 'CartonController@create',
        'middleware' => 'can:process.cartons.create'
    ]);
    $router->post('cartons', [
        'as' => 'admin.process.carton.store',
        'uses' => 'CartonController@store',
        'middleware' => 'can:process.cartons.create'
    ]);
    $router->get('cartons/{carton}/edit', [
        'as' => 'admin.process.carton.edit',
        'uses' => 'CartonController@edit',
        'middleware' => 'can:process.cartons.edit'
    ]);
    $router->put('cartons/{carton}', [
        'as' => 'admin.process.carton.update',
        'uses' => 'CartonController@update',
        'middleware' => 'can:process.cartons.edit'
    ]);
    $router->get('cartons', [
        'as' => 'admin.process.carton.cartonLots',
        'uses' => 'CartonController@cartonLots',
        'middleware' => 'can:process.cartons.edit'
    ]);
    $router->get('cartons\getCartonsfromRelation', [
        'as' => 'admin.process.carton.getCartonsfromRelation',
        'uses' => 'CartonController@getCartonsfromRelation',
        'middleware' => 'can:process.cartons.edit'
    ]);
    $router->delete('cartons/{carton}', [
        'as' => 'admin.process.carton.destroy',
        'uses' => 'CartonController@destroy',
        'middleware' => 'can:process.cartons.destroy'
    ]);
    $router->bind('productcode', function ($id) {
        return app('Modules\Process\Repositories\ProductCodeRepository')->find($id);
    });
    $router->get('productcodes', [
        'as' => 'admin.process.productcode.index',
        'uses' => 'ProductCodeController@index',
        'middleware' => 'can:process.productcodes.index'
    ]);
    $router->get('productcodes/create', [
        'as' => 'admin.process.productcode.create',
        'uses' => 'ProductCodeController@create',
        'middleware' => 'can:process.productcodes.create'
    ]);
    $router->post('productcodes', [
        'as' => 'admin.process.productcode.store',
        'uses' => 'ProductCodeController@store',
        'middleware' => 'can:process.productcodes.create'
    ]);
    $router->get('productcodes/{productcode}/edit', [
        'as' => 'admin.process.productcode.edit',
        'uses' => 'ProductCodeController@edit',
        'middleware' => 'can:process.productcodes.edit'
    ]);
    $router->put('productcodes/{productcode}', [
        'as' => 'admin.process.productcode.update',
        'uses' => 'ProductCodeController@update',
        'middleware' => 'can:process.productcodes.edit'
    ]);
    $router->delete('productcodes/{productcode}', [
        'as' => 'admin.process.productcode.destroy',
        'uses' => 'ProductCodeController@destroy',
        'middleware' => 'can:process.productcodes.destroy'
    ]);
    $router->bind('cartonlocation', function ($id) {
        return app('Modules\Process\Repositories\CartonLocationRepository')->find($id);
    });
    $router->get('cartonlocations', [
        'as' => 'admin.process.cartonlocation.index',
        'uses' => 'CartonLocationController@index',
        'middleware' => 'can:process.cartonlocations.index'
    ]);
    $router->get('cartonlocations/create', [
        'as' => 'admin.process.cartonlocation.create',
        'uses' => 'CartonLocationController@create',
        'middleware' => 'can:process.cartonlocations.create'
    ]);
    $router->post('cartonlocations', [
        'as' => 'admin.process.cartonlocation.store',
        'uses' => 'CartonLocationController@store',
        'middleware' => 'can:process.cartonlocations.create'
    ]);
    $router->get('cartonlocations/{cartonlocation}/edit', [
        'as' => 'admin.process.cartonlocation.edit',
        'uses' => 'CartonLocationController@edit',
        'middleware' => 'can:process.cartonlocations.edit'
    ]);
    $router->put('cartonlocations/{cartonlocation}', [
        'as' => 'admin.process.cartonlocation.update',
        'uses' => 'CartonLocationController@update',
        'middleware' => 'can:process.cartonlocations.edit'
    ]);
    $router->delete('cartonlocations/{cartonlocation}', [
        'as' => 'admin.process.cartonlocation.destroy',
        'uses' => 'CartonLocationController@destroy',
        'middleware' => 'can:process.cartonlocations.destroy'
    ]);
    $router->bind('qualityparameter', function ($id) {
        return app('Modules\Process\Repositories\QualityParameterRepository')->find($id);
    });
    $router->get('qualityparameters', [
        'as' => 'admin.process.qualityparameter.index',
        'uses' => 'QualityParameterController@index',
        'middleware' => 'can:process.qualityparameters.index'
    ]);
    $router->get('qualityparameters/create', [
        'as' => 'admin.process.qualityparameter.create',
        'uses' => 'QualityParameterController@create',
        'middleware' => 'can:process.qualityparameters.create'
    ]);
    $router->post('qualityparameters', [
        'as' => 'admin.process.qualityparameter.store',
        'uses' => 'QualityParameterController@store',
        'middleware' => 'can:process.qualityparameters.create'
    ]);
    $router->get('qualityparameters/{qualityparameter}/edit', [
        'as' => 'admin.process.qualityparameter.edit',
        'uses' => 'QualityParameterController@edit',
        'middleware' => 'can:process.qualityparameters.edit'
    ]);
    $router->put('qualityparameters/{qualityparameter}', [
        'as' => 'admin.process.qualityparameter.update',
        'uses' => 'QualityParameterController@update',
        'middleware' => 'can:process.qualityparameters.edit'
    ]);
    $router->delete('qualityparameters/{qualityparameter}', [
        'as' => 'admin.process.qualityparameter.destroy',
        'uses' => 'QualityParameterController@destroy',
        'middleware' => 'can:process.qualityparameters.destroy'
    ]);
    $router->bind('transfer', function ($id) {
        return app('Modules\Process\Repositories\TransferRepository')->find($id);
    });
    $router->get('transfers', [
        'as' => 'admin.process.transfer.index',
        'uses' => 'TransferController@index',
        'middleware' => 'can:process.transfers.index'
    ]);
    $router->get('transfers/create', [
        'as' => 'admin.process.transfer.create',
        'uses' => 'TransferController@create',
        'middleware' => 'can:process.transfers.create'
    ]);
    $router->post('transfers', [
        'as' => 'admin.process.transfer.store',
        'uses' => 'TransferController@store',
        'middleware' => 'can:process.transfers.create'
    ]);
    $router->get('transfers/{transfer}/edit', [
        'as' => 'admin.process.transfer.edit',
        'uses' => 'TransferController@edit',
        'middleware' => 'can:process.transfers.edit'
    ]);
    $router->put('transfers/{transfer}', [
        'as' => 'admin.process.transfer.update',
        'uses' => 'TransferController@update',
        'middleware' => 'can:process.transfers.edit'
    ]);
    $router->delete('transfers/{transfer}', [
        'as' => 'admin.process.transfer.destroy',
        'uses' => 'TransferController@destroy',
        'middleware' => 'can:process.transfers.destroy'
    ]);
    $router->bind('transfercarton', function ($id) {
        return app('Modules\Process\Repositories\TransferCartonRepository')->find($id);
    });
    $router->get('transfercartons', [
        'as' => 'admin.process.transfercarton.index',
        'uses' => 'TransferCartonController@index',
        'middleware' => 'can:process.transfercartons.index'
    ]);
    $router->get('transfercartons/create', [
        'as' => 'admin.process.transfercarton.create',
        'uses' => 'TransferCartonController@create',
        'middleware' => 'can:process.transfercartons.create'
    ]);
    $router->post('transfercartons', [
        'as' => 'admin.process.transfercarton.store',
        'uses' => 'TransferCartonController@store',
        'middleware' => 'can:process.transfercartons.create'
    ]);
    $router->get('transfercartons/{transfercarton}/edit', [
        'as' => 'admin.process.transfercarton.edit',
        'uses' => 'TransferCartonController@edit',
        'middleware' => 'can:process.transfercartons.edit'
    ]);
    $router->put('transfercartons/{transfercarton}', [
        'as' => 'admin.process.transfercarton.update',
        'uses' => 'TransferCartonController@update',
        'middleware' => 'can:process.transfercartons.edit'
    ]);
    $router->delete('transfercartons/{transfercarton}', [
        'as' => 'admin.process.transfercarton.destroy',
        'uses' => 'TransferCartonController@destroy',
        'middleware' => 'can:process.transfercartons.destroy'
    ]);
    $router->bind('throwing', function ($id) {
        return app('Modules\Process\Repositories\ThrowingRepository')->find($id);
    });
    $router->get('throwings', [
        'as' => 'admin.process.throwing.index',
        'uses' => 'ThrowingController@index',
        'middleware' => 'can:process.throwings.index'
    ]);
    $router->get('throwings/create', [
        'as' => 'admin.process.throwing.create',
        'uses' => 'ThrowingController@create',
        'middleware' => 'can:process.throwings.create'
    ]);
    $router->post('throwings', [
        'as' => 'admin.process.throwing.store',
        'uses' => 'ThrowingController@store',
        'middleware' => 'can:process.throwings.create'
    ]);
    $router->get('throwings/{throwing}/edit', [
        'as' => 'admin.process.throwing.edit',
        'uses' => 'ThrowingController@edit',
        'middleware' => 'can:process.throwings.edit'
    ]);
    $router->get('throwings/loose', [
        'as' => 'admin.process.throwing.loose',
        'uses' => 'ThrowingController@loose',
        'middleware' => 'can:process.throwings.edit'
    ]);
    $router->put('throwings/{throwing}', [
        'as' => 'admin.process.throwing.update',
        'uses' => 'ThrowingController@update',
        'middleware' => 'can:process.throwings.edit'
    ]);
    $router->delete('throwings/{throwing}', [
        'as' => 'admin.process.throwing.destroy',
        'uses' => 'ThrowingController@destroy',
        'middleware' => 'can:process.throwings.destroy'
    ]);
    $router->bind('shipment', function ($id) {
        return app('Modules\Process\Repositories\ShipmentRepository')->find($id);
    });
    $router->get('shipments', [
        'as' => 'admin.process.shipment.index',
        'uses' => 'ShipmentController@index',
        'middleware' => 'can:process.shipments.index'
    ]);
    $router->get('shipments/create', [
        'as' => 'admin.process.shipment.create',
        'uses' => 'ShipmentController@create',
        'middleware' => 'can:process.shipments.create'
    ]);
    $router->post('shipments', [
        'as' => 'admin.process.shipment.store',
        'uses' => 'ShipmentController@store',
        'middleware' => 'can:process.shipments.create'
    ]);
    $router->post('shipments/shipped', [
        'as' => 'admin.process.shipment.shipped',
        'uses' => 'ShipmentController@shipped',
        'middleware' => 'can:process.shipments.create'
    ]);
    $router->get('shipments/{shipment}/edit', [
        'as' => 'admin.process.shipment.edit',
        'uses' => 'ShipmentController@edit',
        'middleware' => 'can:process.shipments.edit'
    ]);
    $router->put('shipments/{shipment}', [
        'as' => 'admin.process.shipment.update',
        'uses' => 'ShipmentController@update',
        'middleware' => 'can:process.shipments.edit'
    ]);
    $router->delete('shipments/{shipment}', [
        'as' => 'admin.process.shipment.destroy',
        'uses' => 'ShipmentController@destroy',
        'middleware' => 'can:process.shipments.destroy'
    ]);
    $router->bind('shipmentcarton', function ($id) {
        return app('Modules\Process\Repositories\ShipmentCartonRepository')->find($id);
    });
    $router->get('shipmentcartons', [
        'as' => 'admin.process.shipmentcarton.index',
        'uses' => 'ShipmentCartonController@index',
        'middleware' => 'can:process.shipmentcartons.index'
    ]);
    $router->get('shipmentcartons/create', [
        'as' => 'admin.process.shipmentcarton.create',
        'uses' => 'ShipmentCartonController@create',
        'middleware' => 'can:process.shipmentcartons.create'
    ]);
    $router->post('shipmentcartons', [
        'as' => 'admin.process.shipmentcarton.store',
        'uses' => 'ShipmentCartonController@store',
        'middleware' => 'can:process.shipmentcartons.create'
    ]);
    $router->get('shipmentcartons/{shipmentcarton}/edit', [
        'as' => 'admin.process.shipmentcarton.edit',
        'uses' => 'ShipmentCartonController@edit',
        'middleware' => 'can:process.shipmentcartons.edit'
    ]);
    $router->put('shipmentcartons/{shipmentcarton}', [
        'as' => 'admin.process.shipmentcarton.update',
        'uses' => 'ShipmentCartonController@update',
        'middleware' => 'can:process.shipmentcartons.edit'
    ]);
    $router->delete('shipmentcartons/{shipmentcarton}', [
        'as' => 'admin.process.shipmentcarton.destroy',
        'uses' => 'ShipmentCartonController@destroy',
        'middleware' => 'can:process.shipmentcartons.destroy'
    ]);
    $router->bind('repack', function ($id) {
        return app('Modules\Process\Repositories\RepackRepository')->find($id);
    });
    $router->get('repacks', [
        'as' => 'admin.process.repack.index',
        'uses' => 'RepackController@index',
        'middleware' => 'can:process.repacks.index'
    ]);
    $router->get('repacks/create', [
        'as' => 'admin.process.repack.create',
        'uses' => 'RepackController@create',
        'middleware' => 'can:process.repacks.create'
    ]);
    $router->post('repacks', [
        'as' => 'admin.process.repack.store',
        'uses' => 'RepackController@store',
        'middleware' => 'can:process.repacks.create'
    ]);
    $router->get('repacks/{repack}/edit', [
        'as' => 'admin.process.repack.edit',
        'uses' => 'RepackController@edit',
        'middleware' => 'can:process.repacks.edit'
    ]);
    $router->put('repacks/{repack}', [
        'as' => 'admin.process.repack.update',
        'uses' => 'RepackController@update',
        'middleware' => 'can:process.repacks.edit'
    ]);
    $router->delete('repacks/{repack}', [
        'as' => 'admin.process.repack.destroy',
        'uses' => 'RepackController@destroy',
        'middleware' => 'can:process.repacks.destroy'
    ]);
    $router->bind('repacking', function ($id) {
        return app('Modules\Process\Repositories\RepackingRepository')->find($id);
    });
    $router->get('repackings', [
        'as' => 'admin.process.repacking.index',
        'uses' => 'RepackingController@index',
        'middleware' => 'can:process.repackings.index'
    ]);
    $router->get('repackings/create', [
        'as' => 'admin.process.repacking.create',
        'uses' => 'RepackingController@create',
        'middleware' => 'can:process.repackings.create'
    ]);
    $router->post('repackings', [
        'as' => 'admin.process.repacking.store',
        'uses' => 'RepackingController@store',
        'middleware' => 'can:process.repackings.create'
    ]);
    $router->get('repackings/{repacking}/edit', [
        'as' => 'admin.process.repacking.edit',
        'uses' => 'RepackingController@edit',
        'middleware' => 'can:process.repackings.edit'
    ]);
    $router->put('repackings/{repacking}', [
        'as' => 'admin.process.repacking.update',
        'uses' => 'RepackingController@update',
        'middleware' => 'can:process.repackings.edit'
    ]);
    $router->delete('repackings/{repacking}', [
        'as' => 'admin.process.repacking.destroy',
        'uses' => 'RepackingController@destroy',
        'middleware' => 'can:process.repackings.destroy'
    ]);
    $router->bind('packing', function ($id) {
        return app('Modules\Process\Repositories\PackingRepository')->find($id);
    });
    $router->get('packings', [
        'as' => 'admin.process.packing.index',
        'uses' => 'PackingController@index',
        'middleware' => 'can:process.packings.index'
    ]);
    $router->get('packings/create', [
        'as' => 'admin.process.packing.create',
        'uses' => 'PackingController@create',
        'middleware' => 'can:process.packings.create'
    ]);
    $router->post('packings', [
        'as' => 'admin.process.packing.store',
        'uses' => 'PackingController@store',
        'middleware' => 'can:process.packings.create'
    ]);
    $router->get('packings/{packing}/edit', [
        'as' => 'admin.process.packing.edit',
        'uses' => 'PackingController@edit',
        'middleware' => 'can:process.packings.edit'
    ]);
    $router->put('packings/{packing}', [
        'as' => 'admin.process.packing.update',
        'uses' => 'PackingController@update',
        'middleware' => 'can:process.packings.edit'
    ]);
    $router->delete('packings/{packing}', [
        'as' => 'admin.process.packing.destroy',
        'uses' => 'PackingController@destroy',
        'middleware' => 'can:process.packings.destroy'
    ]);
// append














});
