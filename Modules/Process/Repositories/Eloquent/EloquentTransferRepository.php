<?php

namespace Modules\Process\Repositories\Eloquent;

use Carbon\Carbon;
use Modules\Process\Entities\TransferCarton;
use Modules\Process\Repositories\CartonLocationRepository;
use Modules\Process\Repositories\TransferCartonRepository;
use Modules\Process\Repositories\TransferRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentTransferRepository extends EloquentBaseRepository implements TransferRepository
{
    public function load($request)
    {
        $data = [
            'container_no' => $request->container_no,
            'vehicle_no' => $request->vehicle_no,
            'loading_location_id' => $request->loading_location_id,
            'unloading_location_id' => $request->unloading_location_id,
            'loading_supervisor' => $request->loading_supervisor,
            'loading_date' => Carbon::parse($request->loading_date) ,
            'loading_start_time' =>Carbon::parse($request->loading_start_time),
            'loading_end_time' =>Carbon::parse($request->loading_end_time) ,
            'status' => $request->status,
            'loading_gate_pass_no' => $request->loading_gate_pass_no,
            'loading_remark' => $request->loading_remark,
        ];
        $transfer = $this->create($data);

        $quantity = $request->carton['quantity'];

        $transferCartons = [];

        $cartonLocationRepo = app(CartonLocationRepository::class);

        foreach ($request->carton['cartonId'] as $key => $value) {

            $quantity = floatval($quantity[$key]);


            $data = [
                'carton_id' => $value,
                'transfer_id' => $transfer->id,
                'quantity' => $quantity,
            ];
            array_push($transferCartons, $data);

            $fromCartonLocation = $cartonLocationRepo->findByAttributes([
                'location_id' => $transfer->loading_location_id,
                'carton_id' => $value
            ]);

            $fromCartonLocation->available_quantity = is_null($fromCartonLocation->available_quantity)?0:$fromCartonLocation->available_quantity  -   $quantity;
            $fromCartonLocation->transit = is_null($fromCartonLocation->transit )?0:$fromCartonLocation->transit  + $quantity;
            $fromCartonLocation->save();


            $toCartonLocation = $cartonLocationRepo->findByAttributes([
                'location_id' => $transfer->unloading_location_id,
                'carton_id' => $value
            ]);

            $toCartonLocation->available_quantity = $fromCartonLocation->available_quantity  +   $quantity;
            $toCartonLocation->save();

        }

        //Insert cartons in transfer cartons
        TransferCarton::insert($transferCartons);

    }


    public function unload($request,$transfer )
    {

        $transfer = $this->find($transfer->id);

        $transfer->unloading_date = Carbon::parse ($request->unloading_date);
        $transfer->unloading_supervisor = $request->unloading_supervisor;
        $transfer->unloading_start_time = Carbon::parse($request->unloading_start_time) ;
        $transfer->status = $request->unloading_status;
        $transfer->unloading_gate_pass_no = $request->unloading_gate_pass_no;
        $transfer->unloading_remark = $request->unloading_remark;
        $transfer->save();


        $recieved = $request->carton['recieved'];

        $transferCartonRepo = app(TransferCarton::class);

        //Update received quantity in Transfer Carton
        foreach ($request->carton['transfer'] as $key => $value)
        {
            $transferproduct  = $transferCartonRepo->find($value);

            $transferproduct->recieved = $recieved[$key];
            $transferproduct->save();

        }

        $cartonLocationRepo = app(CartonLocationRepository::class);

        foreach ($request->carton['cartonId'] as $key => $value)
        {
            $receivedQuantity = floatval($recieved[$key]);

            $toLocation =  $cartonLocationRepo->findByAttribute([
                'location_id' => $transfer->unloading_location_id,
                'carton_id' => $value
            ]);

            $toLocation->available_quantity = $toLocation->available_quantity + $receivedQuantity;
            $toLocation->save();

            $fromCartonLocation =  $cartonLocationRepo->findByAttribute([
                'location_id' => $transfer->loading_location_id,
                'carton_id' => $value
            ]);

            $fromCartonLocation->available_quantity = $fromCartonLocation->available_quantity  -  $receivedQuantity;
            $fromCartonLocation->transit = is_null($fromCartonLocation->transit )?0:$fromCartonLocation->transit  - $receivedQuantity;
            $fromCartonLocation->save();

        }
    }
}
