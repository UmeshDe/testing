<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/admin'], function (Router $router) {
    $router->bind('approvalnumber', function ($id) {
        return app('Modules\Admin\Repositories\ApprovalNumberRepository')->find($id);
    });
    $router->get('approvalnumbers', [
        'as' => 'admin.admin.approvalnumber.index',
        'uses' => 'ApprovalNumberController@index',
        'middleware' => 'can:admin.approvalnumbers.index'
    ]);
    $router->get('approvalnumbers/create', [
        'as' => 'admin.admin.approvalnumber.create',
        'uses' => 'ApprovalNumberController@create',
        'middleware' => 'can:admin.approvalnumbers.create'
    ]);
    $router->post('approvalnumbers', [
        'as' => 'admin.admin.approvalnumber.store',
        'uses' => 'ApprovalNumberController@store',
        'middleware' => 'can:admin.approvalnumbers.create'
    ]);
    $router->get('approvalnumbers/{approvalnumber}/edit', [
        'as' => 'admin.admin.approvalnumber.edit',
        'uses' => 'ApprovalNumberController@edit',
        'middleware' => 'can:admin.approvalnumbers.edit'
    ]);
    $router->put('approvalnumbers/{approvalnumber}', [
        'as' => 'admin.admin.approvalnumber.update',
        'uses' => 'ApprovalNumberController@update',
        'middleware' => 'can:admin.approvalnumbers.edit'
    ]);
    $router->post('approvalnumbers/update', [
        'as' => 'admin.admin.approvalnumber.update',
        'uses' => 'ApprovalNumberController@update',
        'middleware' => 'can:admin.approvalnumbers.edit'
    ]);
    $router->delete('approvalnumbers/{approvalnumber}', [
        'as' => 'admin.admin.approvalnumber.destroy',
        'uses' => 'ApprovalNumberController@destroy',
        'middleware' => 'can:admin.approvalnumbers.destroy'
    ]);
    $router->bind('bagcolor', function ($id) {
        return app('Modules\Admin\Repositories\BagcolorRepository')->find($id);
    });
    $router->get('bagcolors', [
        'as' => 'admin.admin.bagcolor.index',
        'uses' => 'BagcolorController@index',
        'middleware' => 'can:admin.bagcolors.index'
    ]);
    $router->get('bagcolors/create', [
        'as' => 'admin.admin.bagcolor.create',
        'uses' => 'BagcolorController@create',
        'middleware' => 'can:admin.bagcolors.create'
    ]);
    $router->post('bagcolors', [
        'as' => 'admin.admin.bagcolor.store',
        'uses' => 'BagcolorController@store',
        'middleware' => 'can:admin.bagcolors.create'
    ]);
    $router->get('bagcolors/{bagcolor}/edit', [
        'as' => 'admin.admin.bagcolor.edit',
        'uses' => 'BagcolorController@edit',
        'middleware' => 'can:admin.bagcolors.edit'
    ]);
    $router->put('bagcolors/{bagcolor}', [
        'as' => 'admin.admin.bagcolor.update',
        'uses' => 'BagcolorController@update',
        'middleware' => 'can:admin.bagcolors.edit'
    ]);
    $router->post('bagcolors/update', [
        'as' => 'admin.admin.bagcolor.update',
        'uses' => 'BagcolorController@update',
        'middleware' => 'can:admin.bagcolors.edit'
    ]);
    $router->delete('bagcolors/{bagcolor}', [
        'as' => 'admin.admin.bagcolor.destroy',
        'uses' => 'BagcolorController@destroy',
        'middleware' => 'can:admin.bagcolors.destroy'
    ]);
    $router->bind('cartontype', function ($id) {
        return app('Modules\Admin\Repositories\CartonTypeRepository')->find($id);
    });
    $router->get('cartontypes', [
        'as' => 'admin.admin.cartontype.index',
        'uses' => 'CartonTypeController@index',
        'middleware' => 'can:admin.cartontypes.index'
    ]);
    $router->get('cartontypes/create', [
        'as' => 'admin.admin.cartontype.create',
        'uses' => 'CartonTypeController@create',
        'middleware' => 'can:admin.cartontypes.create'
    ]);
    $router->post('cartontypes', [
        'as' => 'admin.admin.cartontype.store',
        'uses' => 'CartonTypeController@store',
        'middleware' => 'can:admin.cartontypes.create'
    ]);
    $router->get('cartontypes/{cartontype}/edit', [
        'as' => 'admin.admin.cartontype.edit',
        'uses' => 'CartonTypeController@edit',
        'middleware' => 'can:admin.cartontypes.edit'
    ]);
    $router->put('cartontypes/{cartontype}', [
        'as' => 'admin.admin.cartontype.update',
        'uses' => 'CartonTypeController@update',
        'middleware' => 'can:admin.cartontypes.edit'
    ]);
    $router->post('cartontypes/update', [
        'as' => 'admin.admin.cartontype.update',
        'uses' => 'CartonTypeController@update',
        'middleware' => 'can:admin.cartontypes.edit'
    ]);
    $router->delete('cartontypes/{cartontype}', [
        'as' => 'admin.admin.cartontype.destroy',
        'uses' => 'CartonTypeController@destroy',
        'middleware' => 'can:admin.cartontypes.destroy'
    ]);
    $router->bind('codemaster', function ($id) {
        return app('Modules\Admin\Repositories\CodeMasterRepository')->find($id);
    });
    $router->get('codemasters', [
        'as' => 'admin.admin.codemaster.index',
        'uses' => 'CodeMasterController@index',
        'middleware' => 'can:admin.codemasters.index'
    ]);
    $router->get('codemasters/create', [
        'as' => 'admin.admin.codemaster.create',
        'uses' => 'CodeMasterController@create',
        'middleware' => 'can:admin.codemasters.create'
    ]);
    $router->post('codemasters', [
        'as' => 'admin.admin.codemaster.store',
        'uses' => 'CodeMasterController@store',
        'middleware' => 'can:admin.codemasters.create'
    ]);
    $router->get('codemasters/{codemaster}/edit', [
        'as' => 'admin.admin.codemaster.edit',
        'uses' => 'CodeMasterController@edit',
        'middleware' => 'can:admin.codemasters.edit'
    ]);
    $router->put('codemasters/{codemaster}', [
        'as' => 'admin.admin.codemaster.update',
        'uses' => 'CodeMasterController@update',
        'middleware' => 'can:admin.codemasters.edit'
    ]);
     $router->post('codemasters/update', [
        'as' => 'admin.admin.codemaster.update',
        'uses' => 'CodeMasterController@update',
        'middleware' => 'can:admin.codemasters.edit'
    ]);
    $router->delete('codemasters/{codemaster}', [
        'as' => 'admin.admin.codemaster.destroy',
        'uses' => 'CodeMasterController@destroy',
        'middleware' => 'can:admin.codemasters.destroy'
    ]);
    $router->bind('department', function ($id) {
        return app('Modules\Admin\Repositories\DepartmentRepository')->find($id);
    });
    $router->get('departments', [
        'as' => 'admin.admin.department.index',
        'uses' => 'DepartmentController@index',
        'middleware' => 'can:admin.departments.index'
    ]);
    $router->get('departments/create', [
        'as' => 'admin.admin.department.create',
        'uses' => 'DepartmentController@create',
        'middleware' => 'can:admin.departments.create'
    ]);
    $router->post('departments', [
        'as' => 'admin.admin.department.store',
        'uses' => 'DepartmentController@store',
        'middleware' => 'can:admin.departments.create'
    ]);
    $router->get('departments/{department}/edit', [
        'as' => 'admin.admin.department.edit',
        'uses' => 'DepartmentController@edit',
        'middleware' => 'can:admin.departments.edit'
    ]);
    $router->put('departments/{department}', [
        'as' => 'admin.admin.department.update',
        'uses' => 'DepartmentController@update',
        'middleware' => 'can:admin.departments.edit'
    ]);
    $router->post('departments/update', [
        'as' => 'admin.admin.department.update',
        'uses' => 'DepartmentController@update',
        'middleware' => 'can:admin.departments.edit'
    ]);
    $router->delete('departments/{department}', [
        'as' => 'admin.admin.department.destroy',
        'uses' => 'DepartmentController@destroy',
        'middleware' => 'can:admin.departments.destroy'
    ]);
    $router->bind('employee', function ($id) {
        return app('Modules\Admin\Repositories\EmployeeRepository')->find($id);
    });
    $router->get('employees', [
        'as' => 'admin.admin.employee.index',
        'uses' => 'EmployeeController@index',
        'middleware' => 'can:admin.employees.index'
    ]);
    $router->get('employees/create', [
        'as' => 'admin.admin.employee.create',
        'uses' => 'EmployeeController@create',
        'middleware' => 'can:admin.employees.create'
    ]);
    $router->post('employees', [
        'as' => 'admin.admin.employee.store',
        'uses' => 'EmployeeController@store',
        'middleware' => 'can:admin.employees.create'
    ]);
    $router->get('employees/{employee}/edit', [
        'as' => 'admin.admin.employee.edit',
        'uses' => 'EmployeeController@edit',
        'middleware' => 'can:admin.employees.edit'
    ]);
    $router->put('employees/{employee}', [
        'as' => 'admin.admin.employee.update',
        'uses' => 'EmployeeController@update',
        'middleware' => 'can:admin.employees.edit'
    ]);
    $router->post('employees/update', [
        'as' => 'admin.admin.employee.update',
        'uses' => 'EmployeeController@update',
        'middleware' => 'can:admin.employees.edit'
    ]);
    $router->delete('employees/{employee}', [
        'as' => 'admin.admin.employee.destroy',
        'uses' => 'EmployeeController@destroy',
        'middleware' => 'can:admin.employees.destroy'
    ]);
    $router->bind('fishtype', function ($id) {
        return app('Modules\Admin\Repositories\FishTypeRepository')->find($id);
    });
    $router->get('fishtypes', [
        'as' => 'admin.admin.fishtype.index',
        'uses' => 'FishTypeController@index',
        'middleware' => 'can:admin.fishtypes.index'
    ]);
    $router->get('fishtypes/create', [
        'as' => 'admin.admin.fishtype.create',
        'uses' => 'FishTypeController@create',
        'middleware' => 'can:admin.fishtypes.create'
    ]);
    $router->post('fishtypes', [
        'as' => 'admin.admin.fishtype.store',
        'uses' => 'FishTypeController@store',
        'middleware' => 'can:admin.fishtypes.create'
    ]);
    $router->get('fishtypes/{fishtype}/edit', [
        'as' => 'admin.admin.fishtype.edit',
        'uses' => 'FishTypeController@edit',
        'middleware' => 'can:admin.fishtypes.edit'
    ]);
    $router->put('fishtypes/{fishtype}', [
        'as' => 'admin.admin.fishtype.update',
        'uses' => 'FishTypeController@update',
        'middleware' => 'can:admin.fishtypes.edit'
    ]);
    $router->post('fishtypes/update', [
        'as' => 'admin.admin.fishtype.update',
        'uses' => 'FishTypeController@update',
        'middleware' => 'can:admin.fishtypes.edit'
    ]);
    $router->delete('fishtypes/{fishtype}', [
        'as' => 'admin.admin.fishtype.destroy',
        'uses' => 'FishTypeController@destroy',
        'middleware' => 'can:admin.fishtypes.destroy'
    ]);
    $router->bind('grade', function ($id) {
        return app('Modules\Admin\Repositories\GradeRepository')->find($id);
    });
    $router->get('grades', [
        'as' => 'admin.admin.grade.index',
        'uses' => 'GradeController@index',
        'middleware' => 'can:admin.grades.index'
    ]);
    $router->get('grades/create', [
        'as' => 'admin.admin.grade.create',
        'uses' => 'GradeController@create',
        'middleware' => 'can:admin.grades.create'
    ]);
    $router->post('grades', [
        'as' => 'admin.admin.grade.store',
        'uses' => 'GradeController@store',
        'middleware' => 'can:admin.grades.create'
    ]);
    $router->get('grades/{grade}/edit', [
        'as' => 'admin.admin.grade.edit',
        'uses' => 'GradeController@edit',
        'middleware' => 'can:admin.grades.edit'
    ]);
    $router->put('grades/{grade}', [
        'as' => 'admin.admin.grade.update',
        'uses' => 'GradeController@update',
        'middleware' => 'can:admin.grades.edit'
    ]);
    $router->post('grades/update', [
        'as' => 'admin.admin.grade.update',
        'uses' => 'GradeController@update',
        'middleware' => 'can:admin.grades.edit'
    ]);
    $router->delete('grades/{grade}', [
        'as' => 'admin.admin.grade.destroy',
        'uses' => 'GradeController@destroy',
        'middleware' => 'can:admin.grades.destroy'
    ]);
    $router->bind('kind', function ($id) {
        return app('Modules\Admin\Repositories\KindRepository')->find($id);
    });
    $router->get('kinds', [
        'as' => 'admin.admin.kind.index',
        'uses' => 'KindController@index',
        'middleware' => 'can:admin.kinds.index'
    ]);
    $router->get('kinds/create', [
        'as' => 'admin.admin.kind.create',
        'uses' => 'KindController@create',
        'middleware' => 'can:admin.kinds.create'
    ]);
    $router->post('kinds', [
        'as' => 'admin.admin.kind.store',
        'uses' => 'KindController@store',
        'middleware' => 'can:admin.kinds.create'
    ]);
    $router->get('kinds/{kind}/edit', [
        'as' => 'admin.admin.kind.edit',
        'uses' => 'KindController@edit',
        'middleware' => 'can:admin.kinds.edit'
    ]);
    $router->put('kinds/{kind}', [
        'as' => 'admin.admin.kind.update',
        'uses' => 'KindController@update',
        'middleware' => 'can:admin.kinds.edit'
    ]);
    $router->post('kinds/update', [
        'as' => 'admin.admin.kind.update',
        'uses' => 'KindController@update',
        'middleware' => 'can:admin.kinds.edit'
    ]);
    $router->delete('kinds/{kind}', [
        'as' => 'admin.admin.kind.destroy',
        'uses' => 'KindController@destroy',
        'middleware' => 'can:admin.kinds.destroy'
    ]);
    $router->bind('location', function ($id) {
        return app('Modules\Admin\Repositories\LocationRepository')->find($id);
    });
    $router->get('locations', [
        'as' => 'admin.admin.location.index',
        'uses' => 'LocationController@index',
        'middleware' => 'can:admin.locations.index'
    ]);
    $router->get('locations/create', [
        'as' => 'admin.admin.location.create',
        'uses' => 'LocationController@create',
        'middleware' => 'can:admin.locations.create'
    ]);
    $router->post('locations', [
        'as' => 'admin.admin.location.store',
        'uses' => 'LocationController@store',
        'middleware' => 'can:admin.locations.create'
    ]);
    $router->get('locations/{location}/edit', [
        'as' => 'admin.admin.location.edit',
        'uses' => 'LocationController@edit',
        'middleware' => 'can:admin.locations.edit'
    ]);
    $router->put('locations/{location}', [
        'as' => 'admin.admin.location.update',
        'uses' => 'LocationController@update',
        'middleware' => 'can:admin.locations.edit'
    ]);
    $router->post('locations/update', [
        'as' => 'admin.admin.location.update',
        'uses' => 'LocationController@update',
        'middleware' => 'can:admin.locations.edit'
    ]);
    $router->delete('locations/{location}', [
        'as' => 'admin.admin.location.destroy',
        'uses' => 'LocationController@destroy',
        'middleware' => 'can:admin.locations.destroy'
    ]);

    $router->bind('designation', function ($id) {
        return app('Modules\Admin\Repositories\DesignationRepository')->find($id);
    });
    $router->get('designations', [
        'as' => 'admin.admin.designation.index',
        'uses' => 'DesignationController@index',
        'middleware' => 'can:admin.designations.index'
    ]);
    $router->get('designations/create', [
        'as' => 'admin.admin.designation.create',
        'uses' => 'DesignationController@create',
        'middleware' => 'can:admin.designations.create'
    ]);
    $router->post('designations', [
        'as' => 'admin.admin.designation.store',
        'uses' => 'DesignationController@store',
        'middleware' => 'can:admin.designations.create'
    ]);
    $router->get('designations/{designation}/edit', [
        'as' => 'admin.admin.designation.edit',
        'uses' => 'DesignationController@edit',
        'middleware' => 'can:admin.designations.edit'
    ]);
    $router->put('designations/{designation}', [
        'as' => 'admin.admin.designation.update',
        'uses' => 'DesignationController@update',
        'middleware' => 'can:admin.designations.edit'
    ]);
    $router->post('designations/update', [
        'as' => 'admin.admin.designation.update',
        'uses' => 'DesignationController@update',
        'middleware' => 'can:admin.designations.edit'
    ]);
    $router->delete('designations/{designation}', [
        'as' => 'admin.admin.designation.destroy',
        'uses' => 'DesignationController@destroy',
        'middleware' => 'can:admin.designations.destroy'
    ]);
    $router->bind('buyercode', function ($id) {
        return app('Modules\Admin\Repositories\BuyercodeRepository')->find($id);
    });
    $router->get('buyercodes', [
        'as' => 'admin.admin.buyercode.index',
        'uses' => 'BuyercodeController@index',
        'middleware' => 'can:admin.buyercodes.index'
    ]);
    $router->get('buyercodes/create', [
        'as' => 'admin.admin.buyercode.create',
        'uses' => 'BuyercodeController@create',
        'middleware' => 'can:admin.buyercodes.create'
    ]);
    $router->post('buyercodes', [
        'as' => 'admin.admin.buyercode.store',
        'uses' => 'BuyercodeController@store',
        'middleware' => 'can:admin.buyercodes.create'
    ]);
    $router->get('buyercodes/{buyercode}/edit', [
        'as' => 'admin.admin.buyercode.edit',
        'uses' => 'BuyercodeController@edit',
        'middleware' => 'can:admin.buyercodes.edit'
    ]);
    $router->put('buyercodes/{buyercode}', [
        'as' => 'admin.admin.buyercode.update',
        'uses' => 'BuyercodeController@update',
        'middleware' => 'can:admin.buyercodes.edit'
    ]);
    $router->post('buyercodes/update', [
        'as' => 'admin.admin.buyercode.update',
        'uses' => 'BuyercodeController@update',
        'middleware' => 'can:admin.buyercodes.edit'
    ]);
    $router->delete('buyercodes/{buyercode}', [
        'as' => 'admin.admin.buyercode.destroy',
        'uses' => 'BuyercodeController@destroy',
        'middleware' => 'can:admin.buyercodes.destroy'
    ]);
    $router->bind('internalcode', function ($id) {
        return app('Modules\Admin\Repositories\InternalcodeRepository')->find($id);
    });
    $router->get('internalcodes', [
        'as' => 'admin.admin.internalcode.index',
        'uses' => 'InternalcodeController@index',
        'middleware' => 'can:admin.internalcodes.index'
    ]);
    $router->get('internalcodes/create', [
        'as' => 'admin.admin.internalcode.create',
        'uses' => 'InternalcodeController@create',
        'middleware' => 'can:admin.internalcodes.create'
    ]);
    $router->post('internalcodes', [
        'as' => 'admin.admin.internalcode.store',
        'uses' => 'InternalcodeController@store',
        'middleware' => 'can:admin.internalcodes.create'
    ]);
    $router->get('internalcodes/{internalcode}/edit', [
        'as' => 'admin.admin.internalcode.edit',
        'uses' => 'InternalcodeController@edit',
        'middleware' => 'can:admin.internalcodes.edit'
    ]);
    $router->put('internalcodes/{internalcode}', [
        'as' => 'admin.admin.internalcode.update',
        'uses' => 'InternalcodeController@update',
        'middleware' => 'can:admin.internalcodes.edit'
    ]);
    $router->post('internalcodes/update', [
        'as' => 'admin.admin.internalcode.update',
        'uses' => 'InternalcodeController@update',
        'middleware' => 'can:admin.internalcodes.edit'
    ]);
    $router->delete('internalcodes/{internalcode}', [
        'as' => 'admin.admin.internalcode.destroy',
        'uses' => 'InternalcodeController@destroy',
        'middleware' => 'can:admin.internalcodes.destroy'
    ]);
    $router->bind('checkmark', function ($id) {
        return app('Modules\Admin\Repositories\CheckmarkRepository')->find($id);
    });
    $router->get('checkmarks', [
        'as' => 'admin.admin.checkmark.index',
        'uses' => 'CheckmarkController@index',
        'middleware' => 'can:admin.checkmarks.index'
    ]);
    $router->get('checkmarks/create', [
        'as' => 'admin.admin.checkmark.create',
        'uses' => 'CheckmarkController@create',
        'middleware' => 'can:admin.checkmarks.create'
    ]);
    $router->post('checkmarks', [
        'as' => 'admin.admin.checkmark.store',
        'uses' => 'CheckmarkController@store',
        'middleware' => 'can:admin.checkmarks.create'
    ]);
    $router->get('checkmarks/{checkmark}/edit', [
        'as' => 'admin.admin.checkmark.edit',
        'uses' => 'CheckmarkController@edit',
        'middleware' => 'can:admin.checkmarks.edit'
    ]);
    $router->put('checkmarks/{checkmark}', [
        'as' => 'admin.admin.checkmark.update',
        'uses' => 'CheckmarkController@update',
        'middleware' => 'can:admin.checkmarks.edit'
    ]);
    $router->post('checkmarks/update', [
        'as' => 'admin.admin.checkmark.update',
        'uses' => 'CheckmarkController@update',
        'middleware' => 'can:admin.checkmarks.edit'
    ]);
    $router->delete('checkmarks/{checkmark}', [
        'as' => 'admin.admin.checkmark.destroy',
        'uses' => 'CheckmarkController@destroy',
        'middleware' => 'can:admin.checkmarks.destroy'
    ]);
// append














});
