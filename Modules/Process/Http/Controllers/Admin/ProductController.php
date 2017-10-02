<?php

namespace Modules\Process\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Admin\Repositories\ApprovalNumberRepository;
use Modules\Admin\Repositories\BagcolorRepository;
use Modules\Admin\Repositories\CartonTypeRepository;
use Modules\Admin\Repositories\CodeMasterRepository;
use Modules\Admin\Repositories\FishTypeRepository;
use Modules\Admin\Repositories\LocationRepository;
use Modules\Process\Entities\Product;
use Modules\Process\Http\Requests\CreateProductRequest;
use Modules\Process\Http\Requests\UpdateProductRequest;
use Modules\Process\Repositories\ProductRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use DB;

class ProductController extends AdminBaseController
{
    /**
     * @var ProductRepository
     */
    private $product;

    public function __construct(ProductRepository $product)
    {
        parent::__construct();

        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $products = $this->product->all();
        return view('process::admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $approvalnumbers = app(ApprovalNumberRepository::class)->allWithBuilder()
            ->orderBy('app_number')
            ->pluck('app_number','id');

        $fishtypes = app(FishTypeRepository::class)->allWithBuilder()
            ->orderBy('type')
            ->pluck('type','id');


        $bagcolors = app(BagcolorRepository::class)->allWithBuilder()
            ->orderBy('color')
            ->pluck('color','id');

        $cartontypes = app(CartonTypeRepository::class)->allWithBuilder()
            ->orderBy('type')
            ->pluck('type','id');

        $locations = app(LocationRepository::class)->allWithBuilder()
            ->orderBy('name')
            ->select(DB::raw("CONCAT(name,'-',location,'-',sublocation) AS name"),'id')
            ->pluck('name','id');


        $codeMasterRepo = app(CodeMasterRepository::class);

        $codemasters = $codeMasterRepo->allWithBuilder()
            ->with('childCodes')
            ->where('is_parent','=',0)
            ->get();

       // return  $codemasters;

        return view('process::admin.products.create', compact('codemasters', 'fishtypes', 'bagcolors', 'codemaster', 'multiplecodes', 'cartontypes', 'locations', 'approvalnumbers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateProductRequest $request
     * @return Response
     */
    public function store(CreateProductRequest $request)
    {
        $data = [
            'product_date' => Carbon::parse($request->product_date),
            'fish_type' => $request->fish_type,
            'no_of_cartons' => $request->no_of_cartons,
            'product_slab' => $request->production_slab,
            'approval_no' => $request->approval_no,
            'rejected' => $request->rejected,
            'loose' => $request->loose,
            'carton_date' => Carbon::parse($request->carton_date),
            'lot_no' => $request->lot_no,
            'po_no' => $request->po_no,
            'carton_type' => $request->carton_type,
            'bag_color' => $request->bag_color,
            'remark' => $request->remark,
        ];
        $production = $this->product->create($data);
        $location = [
            'product_id' => $production->id,
            'location_id' => $request->location_id,
            'lot_no' => $request->lot_no,
            'quantity' => $request->no_of_cartons,
            'quantity_intransit' => 0,
            'available_quantity' => $request->no_of_cartons,
        ];
        $locations = app(getRepoName('Productlocation', 'Production'))->create($location);
        $codes = $request->input('codes');

        foreach ($codes as $code) {
            $productcodes = [
                'product_id' => $production->id,
                'code_id' => $code,
            ];
            $productcode = app(getRepoName('Productcode', 'Production'))->create($productcodes);
        }

        return redirect()->route('admin.process.product.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('process::products.title.products')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Product $product
     * @return Response
     */
    public function edit(Product $product)
    {
        //        var_dump($product->id);
//        return 'sdfa';
//        $productlocationrepo = app(getRepoName('Productlocation','Production'));
        $approvalnumberrepo = app(getRepoName('Approvalnumber', 'Profile'));
        $codemasterrepo = app(getRepoName('Codemaster', 'Profile'));
        $fishtperepo = app(getRepoName('Fishtype', 'Profile'));
        $bagcolorrepo = app(getRepoName('Bagcolor', 'Profile'));
        $cartontyperepo = app(getRepoName('Cartontype', 'Profile'));
        $locationrepo = app(getRepoName('Location', 'Profile'));
//        $productlocations = $productlocationrepo->all();
        $approvalnumbers = $approvalnumberrepo->allWithColumns(['id', 'app_number'], 'app_number');
        $fishtypes = $fishtperepo->allWithColumns(['id', 'type'], 'type');
        $bagcolors = $bagcolorrepo->allWithColumns(['id', 'color'], 'color');
        $codemasters = $codemasterrepo->allWithColumns(['id', 'code', 'is_parent'], 'code', 'is_parent');
        $cartontypes = $cartontyperepo->allWithColumns(['id', 'type'], 'type');
        $locations = $locationrepo->allWithColumns(['id', 'name', 'location', 'sublocation'], 'name', 'location', 'sublocation');
        $codemaster = $codemasterrepo->getByAttributes(['is_parent' => 0]);
        $productlocation = app(getRepoName('Productlocation', 'Production'))->findByAttributes(['product_id' => $product->id]);
        $productlocationId = $productlocation->location_id;

        $multiplecodes = [];
        foreach ($codemaster as $oldcode) {
            $newCode = $codemasterrepo->getByAttributes(['is_parent' => $oldcode->id]);
            array_push($multiplecodes, $newCode);
        }
        return view('process::admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Product $product
     * @param  UpdateProductRequest $request
     * @return Response
     */
    public function update(Product $product, UpdateProductRequest $request)
    {
        $data = [
            'product_date' => Carbon::parse($request->product_date),
            'fish_type' => $request->fish_type,
            'no_of_cartons' => $request->no_of_cartons,
            'product_slab' => $request->production_slab,
            'approval_no' => $request->approval_no,
            'codes' => $request->codes,
            'rejected' => $request->rejected,
            'loose' => $request->loose,
            'carton_date' => Carbon::parse($request->carton_date),
            'lot_no' => $request->lot_no,
            'po_no' => $request->po_no,
            'carton_type' => $request->carton_type,
            'bag_color' => $request->bag_color,
            'location' => $request->location_id,
            'remark' => $request->remark,
        ];
        $this->product->update($product, $data);

        return redirect()->route('admin.process.product.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('process::products.title.products')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product $product
     * @return Response
     */
    public function destroy(Product $product)
    {
        $this->product->destroy($product);

        return redirect()->route('admin.process.product.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('process::products.title.products')]));
    }
}
