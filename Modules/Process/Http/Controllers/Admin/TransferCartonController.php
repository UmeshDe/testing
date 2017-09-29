<?php

namespace Modules\Process\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Process\Entities\TransferCarton;
use Modules\Process\Http\Requests\CreateTransferCartonRequest;
use Modules\Process\Http\Requests\UpdateTransferCartonRequest;
use Modules\Process\Repositories\TransferCartonRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class TransferCartonController extends AdminBaseController
{
    /**
     * @var TransferCartonRepository
     */
    private $transfercarton;

    public function __construct(TransferCartonRepository $transfercarton)
    {
        parent::__construct();

        $this->transfercarton = $transfercarton;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$transfercartons = $this->transfercarton->all();

        return view('process::admin.transfercartons.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('process::admin.transfercartons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateTransferCartonRequest $request
     * @return Response
     */
    public function store(CreateTransferCartonRequest $request)
    {
        $this->transfercarton->create($request->all());

        return redirect()->route('admin.process.transfercarton.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('process::transfercartons.title.transfercartons')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  TransferCarton $transfercarton
     * @return Response
     */
    public function edit(TransferCarton $transfercarton)
    {
        return view('process::admin.transfercartons.edit', compact('transfercarton'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TransferCarton $transfercarton
     * @param  UpdateTransferCartonRequest $request
     * @return Response
     */
    public function update(TransferCarton $transfercarton, UpdateTransferCartonRequest $request)
    {
        $this->transfercarton->update($transfercarton, $request->all());

        return redirect()->route('admin.process.transfercarton.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('process::transfercartons.title.transfercartons')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  TransferCarton $transfercarton
     * @return Response
     */
    public function destroy(TransferCarton $transfercarton)
    {
        $this->transfercarton->destroy($transfercarton);

        return redirect()->route('admin.process.transfercarton.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('process::transfercartons.title.transfercartons')]));
    }
}
