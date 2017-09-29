<?php

namespace Modules\Admin\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Admin\Entities\Location;
use Modules\Admin\Http\Requests\CreateLocationRequest;
use Modules\Admin\Http\Requests\UpdateLocationRequest;
use Modules\Admin\Repositories\LocationRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\User\Contracts\Authentication;

class LocationController extends AdminBaseController
{
    /**
     * @var LocationRepository
     */
    private $location;

    /**
     * @var
     */
    private $auth;

    public function __construct(LocationRepository $location,Authentication $auth)
    {
        parent::__construct();

        $this->location = $location;
        $this->auth = $auth;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $locations = $this->location->all();

        return view('admin::admin.locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin::admin.locations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateLocationRequest $request
     * @return Response
     */
    public function store(CreateLocationRequest $request)
    {
        $data = [
            'name' => $request->name,
            'location' => $request->location,
            'sublocation' => $request->sublocation,
            'details' => $request->details,
            'created_by' => $this->auth->user()->id,
        ];
        $this->location->create($data);

        return redirect()->route('admin.admin.location.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('admin::locations.title.locations')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Location $location
     * @return Response
     */
    public function edit(Location $location)
    {
        return view('admin::admin.locations.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Location $location
     * @param  UpdateLocationRequest $request
     * @return Response
     */
    public function update(Location $location, UpdateLocationRequest $request)
    {
        $location = $this->location->find($request->location_id);
        $data = [
            'name' => $request->name,
            'location' => $request->location,
            'sublocation' => $request->sublocation,
            'details' => $request->details,
            'created_by' => $this->auth->user()->id,
        ];
        $this->location->update($location, $data);

        return redirect()->route('admin.admin.location.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('admin::locations.title.locations')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Location $location
     * @return Response
     */
    public function destroy(Location $location)
    {
        $this->location->destroy($location);

        return redirect()->route('admin.admin.location.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('admin::locations.title.locations')]));
    }
}
