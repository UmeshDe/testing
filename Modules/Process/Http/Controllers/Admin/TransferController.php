<?php

namespace Modules\Process\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Modules\Admin\Repositories\LocationRepository;
use Modules\Process\Entities\Transfer;
use Modules\Process\Entities\TransferCarton;
use Modules\Process\Http\Requests\CreateTransferRequest;
use Modules\Process\Http\Requests\UpdateTransferRequest;
use Modules\Process\Repositories\TransferRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\User\Contracts\Authentication;
use Modules\User\Repositories\UserRepository;

class TransferController extends AdminBaseController
{
    /**
     * @var TransferRepository
     */
    private $transfer;

    /**
     * @var
     */
    private $auth;

    public function __construct(TransferRepository $transfer,Authentication $auth)
    {
        parent::__construct();

        $this->transfer = $transfer;
        $this->auth = $auth;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $transfers = $this->transfer->all();

        return view('process::admin.transfers.index', compact('transfers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        
        $transfers = $this->transfer->find($request->id);
        
        
        $locations = app(LocationRepository::class)->allWithBuilder()
            ->orderBy('name')
            ->select(DB::raw("CONCAT(name,'-',location,'-',sublocation) AS name"),'id')
            ->pluck('name','id');
        
        $users = app(UserRepository::class)->all();
        return view('process::admin.transfers.create',compact('users','locations','transfers','cartons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateTransferRequest $request
     * @return Response
     */
    public function store(CreateTransferRequest $request)
    {
        if($request->button == 'loading') {
            $this->transfer->load($request);
            return redirect()->route('admin.process.transfer.index')
                ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('process::transfers.title.transfers')]));
        }
        else{
            $this->transfer->unload($request);
            return redirect()->route('admin.process.transfer.index')
                ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('process::transfers.title.transfers')]));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Transfer $transfer
     * @return Response
     */
    public function edit(Transfer $transfer)
    {
        $transfer = $this->transfer->allWithBuilder()
            ->with(['transfercarton','loadinglocation','unloadinglocation','transfercarton.carton','transfercarton.carton.product'])
            ->find($transfer->id);

        $users = app(UserRepository::class)->all();

        return view('process::admin.transfers.edit', compact('transfer','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Transfer $transfer
     * @param  UpdateTransferRequest $request
     * @return Response
     */
    public function update(Transfer $transfer, UpdateTransferRequest $request)
    {

        if($request->button == 'loading') {
            $this->transfer->updateLoading($request,$transfer);
        }
        else{
            $this->transfer->unload($request,$transfer);
        }

        return redirect()->route('admin.process.transfer.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('process::transfers.title.transfers')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Transfer $transfer
     * @return Response
     */
    public function destroy(Transfer $transfer)
    {
        $this->transfer->destroy($transfer);

        return redirect()->route('admin.process.transfer.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('process::transfers.title.transfers')]));
    }
}
