<?php

namespace Modules\Admin\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Admin\Entities\Internalcode;
use Modules\Admin\Http\Requests\CreateInternalcodeRequest;
use Modules\Admin\Http\Requests\UpdateInternalcodeRequest;
use Modules\Admin\Repositories\InternalcodeRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\User\Contracts\Authentication;

class InternalcodeController extends AdminBaseController
{
    /**
     * @var InternalcodeRepository
     */
    private $internalcode;

    /**
     * @var
     */
    private $auth;

    public function __construct(InternalcodeRepository $internalcode,Authentication $auth)
    {
        parent::__construct();

        $this->internalcode = $internalcode;
        $this->auth = $auth;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $internalcodes = $this->internalcode->all();

        return view('admin::admin.internalcodes.index', compact('internalcodes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin::admin.internalcodes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateInternalcodeRequest $request
     * @return Response
     */
    public function store(CreateInternalcodeRequest $request)
    {
        $this->internalcode->create($request->all());

        return redirect()->route('admin.admin.internalcode.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('admin::internalcodes.title.internalcodes')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Internalcode $internalcode
     * @return Response
     */
    public function edit(Internalcode $internalcode)
    {
        return view('admin::admin.internalcodes.edit', compact('internalcode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Internalcode $internalcode
     * @param  UpdateInternalcodeRequest $request
     * @return Response
     */
    public function update(Internalcode $internalcode, UpdateInternalcodeRequest $request)
    {
        $internalcode = $this->internalcode->find($request->internalcode_id);

        $this->internalcode->update($internalcode, $request->all());

        return redirect()->route('admin.admin.internalcode.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('admin::internalcodes.title.internalcodes')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Internalcode $internalcode
     * @return Response
     */
    public function destroy(Internalcode $internalcode)
    {
        $this->internalcode->destroy($internalcode);

        return redirect()->route('admin.admin.internalcode.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('admin::internalcodes.title.internalcodes')]));
    }
}
