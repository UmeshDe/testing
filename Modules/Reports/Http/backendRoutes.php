<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/reports'], function (Router $router) {
    $router->bind('reportmaster', function ($id) {
        return app('Modules\Reports\Repositories\ReportMasterRepository')->find($id);
    });
    $router->get('reportmasters', [
        'as' => 'admin.reports.reportmaster.index',
        'uses' => 'ReportMasterController@index',
        'middleware' => 'can:reports.reportmasters.index'
    ]);
    $router->get('reportmasters/create', [
        'as' => 'admin.reports.reportmaster.create',
        'uses' => 'ReportMasterController@create',
        'middleware' => 'can:reports.reportmasters.create'
    ]);
    $router->post('reportmasters', [
        'as' => 'admin.reports.reportmaster.store',
        'uses' => 'ReportMasterController@store',
        'middleware' => 'can:reports.reportmasters.create'
    ]);
    $router->get('reportmasters/{reportmaster}/edit', [
        'as' => 'admin.reports.reportmaster.edit',
        'uses' => 'ReportMasterController@edit',
        'middleware' => 'can:reports.reportmasters.edit'
    ]);
    $router->put('reportmasters/{reportmaster}', [
        'as' => 'admin.reports.reportmaster.update',
        'uses' => 'ReportMasterController@update',
        'middleware' => 'can:reports.reportmasters.edit'
    ]);
    $router->delete('reportmasters/{reportmaster}', [
        'as' => 'admin.reports.reportmaster.destroy',
        'uses' => 'ReportMasterController@destroy',
        'middleware' => 'can:reports.reportmasters.destroy'
    ]);

    $router->post('report/generate', [
        'as' => 'admin.report.generate',
        'uses' => 'ReportMasterController@generate',
        'middleware' => 'can:reports.reportmasters.index'
    ]);
// append

});
