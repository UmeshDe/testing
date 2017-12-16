<?php

namespace Modules\Process\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\Admin\Repositories\BagcolorRepository;
use Modules\Admin\Repositories\CartonTypeRepository;
use Modules\Admin\Repositories\FishTypeRepository;
use Modules\Admin\Repositories\LocationRepository;
use Modules\Process\Entities\Repack;
use Modules\Process\Http\Requests\CreateRepackRequest;
use Modules\Process\Http\Requests\UpdateRepackRequest;
use Modules\Process\Repositories\RepackRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class RepackController extends AdminBaseController
{
    /**
     * @var RepackRepository
     */
    private $repack;

    public function __construct(RepackRepository $repack)
    {
        parent::__construct();

        $this->repack = $repack;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $repacks = $this->repack->all();

        return view('process::admin.repacks.index', compact('repacks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $locations = app(LocationRepository::class)->allWithBuilder()
            ->orderBy('name')
            ->select(DB::raw("CONCAT(name,'-',location,'-',sublocation) AS name"),'id')
            ->pluck('name','id');

        $fishtypes = app(FishTypeRepository::class)->allWithBuilder()
            ->orderBy('type')
            ->pluck('type','id');


        $bagcolors = app(BagcolorRepository::class)->allWithBuilder()
            ->orderBy('color')
            ->pluck('color','id');

        $cartontypes = app(CartonTypeRepository::class)->allWithBuilder()
            ->orderBy('type')
            ->pluck('type','id');

        return view('process::admin.repacks.create',compact('locations','fishtypes','bagcolors','cartontypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateRepackRequest $request
     * @return Response
     */
    public function store(CreateRepackRequest $request)
    {
        $user = auth()->user();
        $data = [
            'carton_date' => $request->carton_date,
            'location_id' => $request->location_id,
            'carton_id' => $request->cartId,
            'damaged_cartons' => $request->damaged_cartons,
            'repacked_cartons' => $request->repacked_cartons,
            'comment' => $request->comment,
            'repackdone_by' => $user->id
        ];

        $this->repack->create($data);

        return redirect()->route('admin.process.repack.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('process::repacks.title.repacks')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Repack $repack
     * @return Response
     */
    public function edit(Repack $repack)
    {
        $locations = app(LocationRepository::class)->allWithBuilder()
            ->orderBy('name')
            ->select(DB::raw("CONCAT(name,'-',location,'-',sublocation) AS name"),'id')
            ->pluck('name','id');

        return view('process::admin.repacks.edit', compact('repack','locations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Repack $repack
     * @param  UpdateRepackRequest $request
     * @return Response
     */
    public function update(Repack $repack, UpdateRepackRequest $request)
    {
        $this->repack->update($repack, $request->all());

        return redirect()->route('admin.process.repack.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('process::repacks.title.repacks')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Repack $repack
     * @return Response
     */
    public function destroy(Repack $repack)
    {
        $this->repack->destroy($repack);

        return redirect()->route('admin.process.repack.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('process::repacks.title.repacks')]));
    }
}
