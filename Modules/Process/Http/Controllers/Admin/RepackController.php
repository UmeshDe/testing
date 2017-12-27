<?php

namespace Modules\Process\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\Admin\Repositories\BagcolorRepository;
use Modules\Admin\Repositories\CartonTypeRepository;
use Modules\Admin\Repositories\FishTypeRepository;
use Modules\Admin\Repositories\GradeRepository;
use Modules\Admin\Repositories\LocationRepository;
use Modules\Process\Entities\Repack;
use Modules\Process\Http\Requests\CreateRepackRequest;
use Modules\Process\Http\Requests\UpdateRepackRequest;
use Modules\Process\Repositories\CartonLocationRepository;
use Modules\Process\Repositories\CartonRepository;
use Modules\Process\Repositories\RepackRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\User\Entities\Sentinel\User;
use Modules\User\Repositories\UserRepository;

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
            ->select(DB::raw("CONCAT(name,'-',location) AS name"),'id')
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

        $grade = app(GradeRepository::class)->allWithBuilder()
            ->orderBy('grade')
            ->pluck('grade','id');

        $users = app(UserRepository::class)->all();

        return view('process::admin.repacks.create',compact('locations','fishtypes','bagcolors','cartontypes','users','grade'));
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

        //Fidn If Any Carton Exist
        $repack = $this->repack->findByAttributes(['lot_no' => $request->lot_no , 'fishtype_id' => $request->fishtype_id]);

        if($repack != null && $repack != "")
        {
            $repack->repacked_cartons = $repack->repacked_cartons + $request->repacked_cartons;
            $repack->remark = $request->remark;
            $repack->fishtype_id = $request->fishtype_id;
            $repack->bagcolor_id = $request->bagcolor_id;
            $repack->cartontype_id = $request->cartontype_id;
            $repack->supervisor_id = $request->supervisor_id;
            $repack->save();
            $this->updateCarton($request);
        }
        else {
            $data = [
                'carton_id' => $request->cartId,
                'location_id' => $request->location_id,
                'repack_date' => $request->repack_date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'supervisor_id' => $request->supervisor_id,
                'fishtype_id' => $request->fishtype_id,
                'bagcolor_id' => $request->bagcolor_id,
                'cartontype_id' => $request->cartontype_id,
                'lot_no' => $request->lot_no,
                'repacked_cartons' => $request->repacked_cartons,
                'remark' => $request->remark,
                'repackingdone_by' => $user->id,
            ];
            $this->repack->create($data);
            $this->updateCarton($request);
        }


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
            ->select(DB::raw("CONCAT(name,'-',location) AS name"),'id')
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

        $grade = app(GradeRepository::class)->allWithBuilder()
            ->orderBy('grade')
            ->pluck('grade','id');

        $users = app(UserRepository::class)->all();

        return view('process::admin.repacks.edit', compact('repack','locations','fishtypes','bagcolors','cartontypes','users','grade'));
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


    public function updateCarton(Request $request)
    {
        $cartonRepo = app(CartonRepository::class)->find($request->cartId);
        $cartonRepo->no_of_cartons = $cartonRepo->no_of_cartons - $request->repacked_cartons;
        $cartonRepo->save();

        $updateCartonLocation = app(CartonLocationRepository::class)->findByAttributes(['carton_id' => $request->cartId ,  'location_id' => $request->location_id ]);
        $updateCartonLocation->available_quantity = $updateCartonLocation->available_quantity - $request->repacked_cartons;
        $updateCartonLocation->save();
    }

}
