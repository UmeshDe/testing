<?php

namespace Modules\Process\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Process\Entities\ProductCode;
use Modules\Process\Http\Requests\CreateProductCodeRequest;
use Modules\Process\Http\Requests\UpdateProductCodeRequest;
use Modules\Process\Repositories\ProductCodeRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class ProductCodeController extends AdminBaseController
{
    /**
     * @var ProductCodeRepository
     */
    private $productcode;

    public function __construct(ProductCodeRepository $productcode)
    {
        parent::__construct();

        $this->productcode = $productcode;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$productcodes = $this->productcode->all();

        return view('process::admin.productcodes.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('process::admin.productcodes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateProductCodeRequest $request
     * @return Response
     */
    public function store(CreateProductCodeRequest $request)
    {
        $this->productcode->create($request->all());

        return redirect()->route('admin.process.productcode.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('process::productcodes.title.productcodes')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  ProductCode $productcode
     * @return Response
     */
    public function edit(ProductCode $productcode)
    {
        return view('process::admin.productcodes.edit', compact('productcode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProductCode $productcode
     * @param  UpdateProductCodeRequest $request
     * @return Response
     */
    public function update(ProductCode $productcode, UpdateProductCodeRequest $request)
    {
        $this->productcode->update($productcode, $request->all());

        return redirect()->route('admin.process.productcode.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('process::productcodes.title.productcodes')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  ProductCode $productcode
     * @return Response
     */
    public function destroy(ProductCode $productcode)
    {
        $this->productcode->destroy($productcode);

        return redirect()->route('admin.process.productcode.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('process::productcodes.title.productcodes')]));
    }
}
