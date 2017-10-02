<?php

namespace Modules\Admin\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Admin\Entities\Kind;
use Modules\Admin\Http\Requests\CreateKindRequest;
use Modules\Admin\Http\Requests\UpdateKindRequest;
use Modules\Admin\Repositories\KindRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\User\Contracts\Authentication;

class KindController extends AdminBaseController
{
    /**
     * @var KindRepository
     */
    private $kind;

    /**
     * @var
     */
    private $auth;

    public function __construct(KindRepository $kind,Authentication $auth)
    {
        parent::__construct();

        $this->kind = $kind;
        $this->auth = $auth;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $kinds = $this->kind->all();

        return view('admin::admin.kinds.index', compact('kinds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin::admin.kinds.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateKindRequest $request
     * @return Response
     */
    public function store(CreateKindRequest $request)
    {
        $data = [
          'kind' => $request->kind,
          'created_by'=> $this->auth->user()->id,
        ];
        $this->kind->create($data);

        return redirect()->route('admin.admin.kind.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('admin::kinds.title.kinds')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Kind $kind
     * @return Response
     */
    public function edit(Kind $kind)
    {
        return view('admin::admin.kinds.edit', compact('kind'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Kind $kind
     * @param  UpdateKindRequest $request
     * @return Response
     */
    public function update(Kind $kind, UpdateKindRequest $request)
    {
        $kind = $this->kind->find($request->kind_id);
        $data = [
            'kind' => $request->kind,
            'updated_by'=> $this->auth->user()->id,
        ];
        $this->kind->update($kind, $data);

        return redirect()->route('admin.admin.kind.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('admin::kinds.title.kinds')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Kind $kind
     * @return Response
     */
    public function destroy(Kind $kind)
    {
        $this->kind->destroy($kind);

        return redirect()->route('admin.admin.kind.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('admin::kinds.title.kinds')]));
    }
}
