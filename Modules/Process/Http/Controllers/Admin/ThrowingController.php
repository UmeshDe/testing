<?php

namespace Modules\Process\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\Admin\Repositories\LocationRepository;
use Modules\Process\Entities\Throwing;
use Modules\Process\Http\Requests\CreateThrowingRequest;
use Modules\Process\Http\Requests\UpdateThrowingRequest;
use Modules\Process\Repositories\CartonLocationRepository;
use Modules\Process\Repositories\CartonRepository;
use Modules\Process\Repositories\ThrowingRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\User\Repositories\UserRepository;

class ThrowingController extends AdminBaseController
{
    /**
     * @var ThrowingRepository
     */
    private $throwing;

    public function __construct(ThrowingRepository $throwing)
    {
        parent::__construct();

        $this->throwing = $throwing;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $throwings = $this->throwing->all();

        return view('process::admin.throwings.index', compact('throwings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $cartonlocation = app(CartonRepository::class)->allWithBuilder()
            ->select('*',DB::raw("    CONCAT('Carton Date :',coalesce(carton_date,''),' (', 'Qty :'  ,coalesce(no_of_cartons,''),')') AS product"),'loose','id')
            ->get();

        $locations = app(LocationRepository::class)->allWithBuilder()
            ->orderBy('name')
            ->select(DB::raw("CONCAT(name,'-',location) AS name"),'id')
            ->pluck('name','id');

        $users = app(UserRepository::class)->all();

        $throwing = new Throwing();
        return view('process::admin.throwings.create',compact('cartonlocation','locations','throwing','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateThrowingRequest $request
     * @return Response
     */
    public function store(CreateThrowingRequest $request)
    {
        if($request->cartId != null)
        {
            $user = auth()->user();
            $cartonRepo = app(CartonRepository::class)->find($request->cartId);
            $cartonRepo->no_of_cartons = $cartonRepo->no_of_cartons - $request->throwing_input;
            $cartonRepo->save();

            $updateCartonLocation = app(CartonLocationRepository::class)->findByAttributes(['carton_id' => $request->cartId ,  'location_id' => $request->location_id ]);
            $updateCartonLocation->available_quantity = $updateCartonLocation->available_quantity - $request->throwing_input;
            $updateCartonLocation->save();

            $thowdata = [
                'carton_date' => $request->carton_date,
                'location_id' => $request->location_id,
                'thowing_start_time' =>Carbon::parse($request->thowing_start_time),
                'thowing_end_time' =>Carbon::parse($request->thowing_end_time),
                'thowing_supervisor' => $request->thowing_supervisor,
                'comment' => $request->comment,
                'throwing_input' => $request->throwing_input,
                'carton_id' => $request->cartId,
                'user_id' => $user->id,
                'thowingdone_by' => $user->id
            ];

            $this->throwing->create($thowdata);
            return redirect()->route('admin.process.throwing.index')
                ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('process::throwings.title.throwings')]));
        }
        else {
            return "Select Carton";
        }

//        $data = [
//            'product_id' => $cartonRepo->product_id,
//          'carton_date' => $request->carton_date,
//            'location_id' => $request->location_id,
//            'no_of_cartons' => $request->throwing_output,
//            'loose' => $request->loose_bags,
//        ];
//        $newCarton  =  $cartonRepo->create($data);


//        $productLocation = app(CartonLocationRepository::class)->addCarton($request->location_id,$newCarton);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Throwing $throwing
     * @return Response
     */
    public function edit(Throwing $throwing)
    {

        $cartonlocation = app(CartonRepository::class)->allWithBuilder()
            ->select('*',DB::raw("    CONCAT('Carton Date :',coalesce(carton_date,''),' (', 'Qty :'  ,coalesce(no_of_cartons,''),')') AS product"),'loose','id')
            ->get();

        $locations = app(LocationRepository::class)->allWithBuilder()
            ->orderBy('name')
            ->select(DB::raw("CONCAT(name,'-',location) AS name"),'id')
            ->pluck('name','id');

        $users = app(UserRepository::class)->all();

        return view('process::admin.throwings.edit', compact('throwing','locations','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Throwing $throwing
     * @param  UpdateThrowingRequest $request
     * @return Response
     */
    public function update(Throwing $throwing, UpdateThrowingRequest $request)
    {
        $this->throwing->update($throwing, $request->all());

        return redirect()->route('admin.process.throwing.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('process::throwings.title.throwings')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Throwing $throwing
     * @return Response
     */
    public function destroy(Throwing $throwing)
    {
        $this->throwing->destroy($throwing);

        return redirect()->route('admin.process.throwing.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('process::throwings.title.throwings')]));
    }


    public function loose(Request $request)
    {
        $loosebags = app(CartonLocationRepository::class)->find($request->id);
        
        return response()->json(['success' => true , 'message' => 'Successful' , 'loose' => $loosebags ]);
    }
}
