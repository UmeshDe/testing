<?php

namespace Modules\Admin\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Admin\Entities\Bagcolor;
use Modules\Admin\Http\Requests\CreateBagcolorRequest;
use Modules\Admin\Http\Requests\UpdateBagcolorRequest;
use Modules\Admin\Repositories\BagcolorRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\User\Contracts\Authentication;

class BagcolorController extends AdminBaseController
{
    /**
     * @var BagcolorRepository
     */
    private $bagcolor;

    /**
     * @var
     */
    private $auth;
    
    public function __construct(BagcolorRepository $bagcolor,Authentication $auth)
    {
        parent::__construct();

        $this->bagcolor = $bagcolor;
        $this->auth = $auth;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $bagcolors = $this->bagcolor->all();

//        dd($bagcolor);
//        $bagcolors = collect($bagcolor)->sortByDesc('created_at');


        return view('admin::admin.bagcolors.index', compact('bagcolors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin::admin.bagcolors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateBagcolorRequest $request
     * @return Response
     */
    public function store(CreateBagcolorRequest $request)
    {
        $data = [
            'color' => $request->color,
            'created_by'=> $this->auth->user()->id,
        ];
        $this->bagcolor->create($data);

        return redirect()->route('admin.admin.bagcolor.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('admin::bagcolors.title.bagcolors')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Bagcolor $bagcolor
     * @return Response
     */
    public function edit(Bagcolor $bagcolor)
    {
        return view('admin::admin.bagcolors.edit', compact('bagcolor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Bagcolor $bagcolor
     * @param  UpdateBagcolorRequest $request
     * @return Response
     */
    public function update(Bagcolor $bagcolor, UpdateBagcolorRequest $request)
    {
        $bagcolor = $this->bagcolor->find($request->color_id);
        $data = [
            'color' => $request->color,
            'created_by'=> $this->auth->user()->id,
        ];
        $this->bagcolor->update($bagcolor, $data);
        return redirect()->route('admin.admin.bagcolor.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('admin::bagcolors.title.bagcolors')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Bagcolor $bagcolor
     * @return Response
     */
    public function destroy(Bagcolor $bagcolor)
    {
        $this->bagcolor->destroy($bagcolor);

        return redirect()->route('admin.admin.bagcolor.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('admin::bagcolors.title.bagcolors')]));
    }
}
