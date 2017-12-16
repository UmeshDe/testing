<?php

namespace Modules\Admin\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Admin\Entities\Buyercode;
use Modules\Admin\Http\Requests\CreateBuyercodeRequest;
use Modules\Admin\Http\Requests\UpdateBuyercodeRequest;
use Modules\Admin\Repositories\BuyercodeRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class BuyercodeController extends AdminBaseController
{
    /**
     * @var BuyercodeRepository
     */
    private $buyercode;

    public function __construct(BuyercodeRepository $buyercode)
    {
        parent::__construct();

        $this->buyercode = $buyercode;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $buyercodes = $this->buyercode->all();

        return view('admin::admin.buyercodes.index', compact('buyercodes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin::admin.buyercodes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateBuyercodeRequest $request
     * @return Response
     */
    public function store(CreateBuyercodeRequest $request)
    {
        $this->buyercode->create($request->all());

        return redirect()->route('admin.admin.buyercode.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('admin::buyercodes.title.buyercodes')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Buyercode $buyercode
     * @return Response
     */
    public function edit(Buyercode $buyercode)
    {
        return view('admin::admin.buyercodes.edit', compact('buyercode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Buyercode $buyercode
     * @param  UpdateBuyercodeRequest $request
     * @return Response
     */
    public function update(Buyercode $buyercode, UpdateBuyercodeRequest $request)
    {
        $buyercode = $this->buyercode->find($request->buyercode_id);

        $this->buyercode->update($buyercode, $request->all());

        return redirect()->route('admin.admin.buyercode.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('admin::buyercodes.title.buyercodes')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Buyercode $buyercode
     * @return Response
     */
    public function destroy(Buyercode $buyercode)
    {
        $this->buyercode->destroy($buyercode);

        return redirect()->route('admin.admin.buyercode.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('admin::buyercodes.title.buyercodes')]));
    }
}
