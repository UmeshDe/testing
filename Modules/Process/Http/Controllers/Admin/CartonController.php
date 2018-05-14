<?php

namespace Modules\Process\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\Process\Entities\Carton;
use Modules\Process\Http\Requests\CreateCartonRequest;
use Modules\Process\Http\Requests\UpdateCartonRequest;
use Modules\Process\Repositories\CartonLocationRepository;
use Modules\Process\Repositories\CartonRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class CartonController extends AdminBaseController
{
    /**
     * @var CartonRepository
     */
    private $carton;

    public function __construct(CartonRepository $carton)
    {
        parent::__construct();

        $this->carton = $carton;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$cartons = $this->carton->all();

        return view('process::admin.cartons.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('process::admin.cartons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateCartonRequest $request
     * @return Response
     */
    public function store(CreateCartonRequest $request)
    {
        $this->carton->create($request->all());

        return redirect()->route('admin.process.carton.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('process::cartons.title.cartons')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Carton $carton
     * @return Response
     */
    public function edit(Carton $carton)
    {
        return view('process::admin.cartons.edit', compact('carton'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Carton $carton
     * @param  UpdateCartonRequest $request
     * @return Response
     */
    public function update(Carton $carton, UpdateCartonRequest $request)
    {
        $this->carton->update($carton, $request->all());

        return redirect()->route('admin.process.carton.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('process::cartons.title.cartons')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Carton $carton
     * @return Response
     */
    public function destroy(Carton $carton)
    {
        $this->carton->destroy($carton);

        return redirect()->route('admin.process.carton.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('process::cartons.title.cartons')]));
    }
    /**
     *
     */
    public function cartonLots(Request $request)
    {
        //Find Fishtypes In Selected Location
        $cartonlocation = app(CartonLocationRepository::class)->allWithBuilder()->where('location_id', '=' , $request->id)
            ->with(['carton.product.fishtype'])
            ->get()
            ->unique('carton.product.fishtype.type');
        
        return response()->json($cartonlocation);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function cartonDate(Request $request)
    {
        //To Find Carton Date Of Selected Fishtype and Loading Location
        $cartonDate = DB::table("process__cartonlocations")
            ->join('process__cartons','process__cartons.id','=','process__cartonlocations.carton_id')
            ->join('process__products','process__products.id','=','process__cartons.product_id')
            ->select('process__products.carton_date')
            ->where('process__cartonlocations.location_id',$request->id)
            ->where('process__products.fish_type',$request->type)
            ->groupBy('process__products.carton_date')
            ->get();

        return response()->json($cartonDate);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function lotNumber(Request $request)
    {
        //To find lot number of selected fishtype and loading location
        $lotNumber = DB::table("process__cartonlocations")
            ->join('process__cartons','process__cartons.id','=','process__cartonlocations.carton_id')
            ->join('process__products','process__products.id','=','process__cartons.product_id')
            ->select('process__products.lot_no')
            ->where('process__cartonlocations.location_id',$request->id)
            ->where('process__products.fish_type',$request->type)
            ->where('process__products.carton_date',Carbon::parse($request->cartonDate)->format('Y-m-d'))
            ->get();

        return response()->json($lotNumber);
    }


    public function availableQty(Request $request)
    {
        $availableQty = DB::table("process__cartonlocations")
            ->join('process__cartons','process__cartons.id','=','process__cartonlocations.carton_id')
            ->join('process__products','process__products.id','=','process__cartons.product_id')
            ->select('available_quantity','carton_id')
            ->where('process__cartonlocations.location_id',$request->id)
            ->where('process__products.fish_type',$request->type)
            ->where('process__products.carton_date',Carbon::parse($request->cartonDate)->format('Y-m-d'))
            ->where('process__products.lot_no',$request->lot)
            ->get();

        return response()->json($availableQty);
    }
    
    
    //From Location And Varity Selection
    public function getCartonsfromRelation(Request $request)
    {
        $cartonlocation = app(CartonLocationRepository::class)->allWithBuilder()->where('location_id', '=' , $request->id)->with(['carton','location','carton.product'])->whereHas('carton.product', function($query) use($request) {
            return $query->whereIn('fish_type', \GuzzleHttp\json_decode($request->fishtype));
        })->get();

        return response()->json($cartonlocation);
    }



}
