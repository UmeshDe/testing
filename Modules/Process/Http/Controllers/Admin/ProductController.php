<?php

namespace Modules\Process\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Modules\Admin\Repositories\ApprovalNumberRepository;
use Modules\Admin\Repositories\BagcolorRepository;
use Modules\Admin\Repositories\BuyercodeRepository;
use Modules\Admin\Repositories\CartonTypeRepository;
use Modules\Admin\Repositories\CheckmarkRepository;
use Modules\Admin\Repositories\CodeMasterRepository;
use Modules\Admin\Repositories\FishTypeRepository;
use Modules\Admin\Repositories\LocationRepository;
use Modules\Process\Entities\Product;
use Modules\Process\Http\Requests\CreateProductRequest;
use Modules\Process\Http\Requests\UpdateProductRequest;
use Modules\Process\Repositories\CartonLocationRepository;
use Modules\Process\Repositories\CartonRepository;
use Modules\Process\Repositories\ProductRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use DB;
use Modules\User\Contracts\Authentication;
use Yajra\DataTables\DataTables;

class ProductController extends AdminBaseController
{
    /**
     * @var ProductRepository
     */
    private $product;

    /**
     * @var
     */
    private $auth;

    public function __construct(ProductRepository $product,Authentication $auth)
    {
        parent::__construct();

        $this->product = $product;
        $this->auth = $auth;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
//        $products = $this->product->all();


//        $query = $this->product->allWithBuilder();


        $query = Product::with('fishtype','bagcolor')->get()->take(200);

        if(request()->ajax() == true ) {

            return DataTables::of($query)
//                ->addColumn('chkbox',function ($order){
//                    return '<input type="checkbox" name="ids[]" value="'. $order->workflow->id .'">';
//                })
                ->addColumn('product_date', function ($product) {
                    return $product->product_date;
                })
                ->addColumn('lot_no', function ($product) {
                    return $product->lot_no;
                })
                ->addColumn('fishtype', function ($product) {
                    return $product->variety->type;
                })
                ->addColumn('bagcolor', function ($product) {
                    return isset($product->bagColor) ? $product->bagColor->color : 'NULL';
                })
                ->addColumn('product_slab', function ($product) {
                    return $product->product_slab;
                })
                ->addColumn('action',function ($product){

                    $links = link_to_route('admin.process.product.edit','Edit',$product->id,['class'=>'btn btn-default btn-flat']);
                    $links .= link_to_route('admin.process.product.destroy','Delete',$product->id,['class'=>'btn btn-danger btn-flat']);

                    return $links;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
         else {
             DataTables::of($query)
//                ->addColumn('chkbox',function ($order){
//                    return '<input type="checkbox" name="ids[]" value="'. $order->workflow->id .'">';
//                })
                 ->addColumn('product_date', function ($product) {
                     return $product->product_date;
                 })
                 ->addColumn('lot_no', function ($product) {
                     return $product->lot_no;
                 })
                 ->addColumn('fishtype', function ($product) {
                     return $product->variety->type;
                 })
                 ->addColumn('bagcolor', function ($product) {
                     return isset($product->bagColor) ? $product->bagColor->color : 'NULL';
                 })
                 ->addColumn('product_slab', function ($product) {
                     return $product->product_slab;
                 })
                 ->addColumn('action',function ($product){

                     $links = link_to_route('admin.process.product.edit','Edit',$product->id,['class'=>'btn btn-default btn-flat']);
                     $links .= link_to_route('admin.process.product.destroy','Delete',$product->id,['class'=>'btn btn-default btn-flat']);

                     return $links;
                 })
                 ->rawColumns(['action'])
                 ->make(true);
         }

        return view('process::admin.products.index', compact('products','query'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function packingindex()
    {
        $query = Product::with('fishtype','bagcolor')->get()->where('packingdone',false);

        if(request()->ajax() == true ) {

            return DataTables::of($query)
//                ->addColumn('chkbox',function ($order){
//                    return '<input type="checkbox" name="ids[]" value="'. $order->workflow->id .'">';
//                })
                ->addColumn('product_date', function ($product) {
                    return $product->product_date;
                })
                ->addColumn('lot_no', function ($product) {
                    return $product->lot_no;
                })
                ->addColumn('product_slab', function ($product) {
                    return $product->product_slab;
                })
                ->addColumn('created_at', function ($product) {
                    return $product->created_at;
                })
                ->addColumn('action',function ($product){

                    $links = link_to_route('admin.process.product.edit','Packing Pending',$product->id,['class'=>'btn btn-danger btn-flat']);
                    return $links;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('process::admin.products.packingindex', compact('query'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function packingcreate(Product $product)
    {
        $approvalnumbers = app(ApprovalNumberRepository::class)->allWithBuilder()
            ->orderBy('app_number')
            ->pluck('app_number','id');

        $fishtypes = app(FishTypeRepository::class)->allWithBuilder()
            ->orderBy('type')
            ->pluck('type','id');

        $cm = app(CheckmarkRepository::class)->allWithBuilder()
            ->orderBy('cm')
            ->pluck('cm','id');

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


        $data = [
            'approvalnumbers' => $approvalnumbers,
            'fishtypes' =>$fishtypes,
            'bagcolors'=>$bagcolors,
            'cartontypes'=>$cartontypes,
            'locations'=>$locations,
            'codemasters'=>$codemasters,
            'product'=>$product,
            'cm' => $cm
        ];

        return view('process::admin.products.edit')->with($data);
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

        $cm = app(CheckmarkRepository::class)->allWithBuilder()
            ->orderBy('cm')
            ->pluck('cm','id');

        $bagcolors = app(BagcolorRepository::class)->allWithBuilder()
            ->orderBy('color')
            ->pluck('color','id');

        $cartontypes = app(CartonTypeRepository::class)->allWithBuilder()
            ->orderBy('type')
            ->pluck('type','id');

        $buyercode = app(BuyercodeRepository::class)->allWithBuilder()
            ->orderBy('buyer_code')
            ->pluck('buyer_code','id');

        $locations = app(LocationRepository::class)->allWithBuilder()
            ->orderBy('name')
            ->select(DB::raw("CONCAT(name,'-',location) AS name"),'id')
            ->pluck('name','id');

        $codeMasterRepo = app(CodeMasterRepository::class);

        $fm = $codeMasterRepo->allWithBuilder()
                ->where('is_parent' ,'=',1)
                ->orderBy('code')
                ->pluck('code','id');

        $fr = $codeMasterRepo->allWithBuilder()
                ->where('is_parent' ,'=',2)
                ->orderBy('code')
                ->pluck('code','id');
        
        $d = $codeMasterRepo->allWithBuilder()
                ->where('is_parent','=',3)
                ->orderBy('code')
                ->pluck('code','id');
        
        $s = $codeMasterRepo->allWithBuilder()
                ->where('is_parent' ,'=',4)
                ->orderBy('code')
                ->pluck('code','id');
        
        $a = $codeMasterRepo->allWithBuilder()
                ->where('is_parent','=',5)
                ->orderBy('code')
                ->pluck('code','id');
        
        $c = $codeMasterRepo->allWithBuilder()
                ->where('is_parent' ,'=' ,6)
                ->orderBy('code')
                ->pluck('code','id');
        
        $p= $codeMasterRepo->allWithBuilder()
                ->where('is_parent','=',7)
                ->orderBy('code')
                ->pluck('code','id');
        
        $b= $codeMasterRepo->allWithBuilder()
                ->where('is_parent','=',8)
                ->orderBy('code')
                ->pluck('code','id');
        
        $m = $codeMasterRepo->allWithBuilder()
                ->where('is_parent','=',9)
                ->orderBy('code')
                ->pluck('code','id');

        $w = $codeMasterRepo->allWithBuilder()
                ->where('is_parent','=',10)
                ->orderBy('code')
                ->pluck('code','id');

        $q = $codeMasterRepo->allWithBuilder()
                ->where('is_parent','=',11)
                ->orderBy('code')
                ->pluck('code','id');

        $sc = $codeMasterRepo->allWithBuilder()
                ->where('is_parent','=',12)
                ->orderBy('code')
                ->pluck('code','id');

        $lc = $codeMasterRepo->allWithBuilder()
                ->where('is_parent','=',13)
                ->orderBy('code')
                ->pluck('code','id');

        $i = $codeMasterRepo->allWithBuilder()
                ->where('is_parent','=',245)
                ->orderBy('code')
                ->pluck('code','id');

        $k = $codeMasterRepo->allWithBuilder()
                ->where('is_parent','=',268)
                ->orderBy('code')
                ->pluck('code','id');

        $e = $codeMasterRepo->allWithBuilder()
                ->where('is_parent','=',277)
                ->orderBy('code')
                ->pluck('code','id');

        $t = $codeMasterRepo->allWithBuilder()
                ->where('is_parent','=',278)
                ->orderBy('code')
                ->pluck('code','id');

        $sg = $codeMasterRepo->allWithBuilder()
                ->where('is_parent','=',279)
                ->orderBy('code')
                ->pluck('code','id');

        //where is_parent == 280
        $kg = $codeMasterRepo->allWithBuilder()
                ->where('is_parent','=',488)
                ->orderBy('code')
                ->pluck('code','id');

        $g = $codeMasterRepo->allWithBuilder()
                ->where('is_parent','=',281)
                ->orderBy('code')
                ->pluck('code','id');

        $h = $codeMasterRepo->allWithBuilder()
                ->where('is_parent','=',282)
                ->orderBy('code')
                ->pluck('code','id');

//        $m = $codeMasterRepo->allWithBuilder()
//                ->where('is_parent','=',283)
//                ->orderBy('code')
//                ->pluck('code','id');

        $rc = $codeMasterRepo->allWithBuilder()
                ->where('is_parent','=',284)
                ->orderBy('code')
                ->pluck('code','id');

        $mk = $codeMasterRepo->allWithBuilder()
                ->where('is_parent','=',285)
                ->orderBy('code')
                ->pluck('code','id');

        
        
        $codes = [
            'fm' => $fm,
            'fr' => $fr,
            'd' => $d,
            's' => $s,
            'a' => $a,
            'c' => $c,
            'p' => $p,
            'b' => $b,
            'm' => $m,
            'w' => $w,
            'q' => $q,
            'sc' => $sc,
            'lc' => $lc,
            'i' => $i,
            'k' => $k,
            'e' => $e,
            't' => $t,
            'sg' => $sg,
            'kg' => $kg,
            'g' => $g,
            'h' => $h,
            'rc' => $rc,
            'mk' => $mk
        ];

        $product = new Product();

        return view('process::admin.products.create', compact('codemasters', 'fishtypes', 'bagcolors', 'codemaster', 'multiplecodes', 'cartontypes', 'locations', 'approvalnumbers','product','buyercode','codes','cm'))->with($codes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateProductRequest $request
     * @return Response
     */
    public function store(CreateProductRequest $request)
    {

        //Create new product
        $production = $this->product->createProduct($request);
        
        //Create new carton
//        $carton = app(CartonRepository::class)->createCarton($production,$request->all());
//
//        //Add carton to location
//        $productLocation = app(CartonLocationRepository::class)->addCarton($carton->location_id,$carton);

        //Add product codes
        $codes = $request->input('code');

        $production->codes()->attach($codes);

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
        $approvalnumbers = app(ApprovalNumberRepository::class)->allWithBuilder()
            ->orderBy('app_number')
            ->pluck('app_number','id');

        $fishtypes = app(FishTypeRepository::class)->allWithBuilder()
            ->orderBy('type')
            ->pluck('type','id');

        $cm = app(CheckmarkRepository::class)->allWithBuilder()
            ->orderBy('cm')
            ->pluck('cm','id');

        $bagcolors = app(BagcolorRepository::class)->allWithBuilder()
            ->orderBy('color')
            ->pluck('color','id');

        $cartontypes = app(CartonTypeRepository::class)->allWithBuilder()
            ->orderBy('type')
            ->pluck('type','id');

        $locations = app(LocationRepository::class)->allWithBuilder()
            ->orderBy('name')
            ->select(DB::raw("CONCAT(name,'-',location) AS name"),'id')
            ->pluck('name','id');

        $buyercode = app(BuyercodeRepository::class)->allWithBuilder()
            ->orderBy('buyer_code')
            ->pluck('buyer_code','id');
        
        $codeMasterRepo = app(CodeMasterRepository::class);

        $codemasters = $codeMasterRepo->allWithBuilder()
            ->with('childCodes')
            ->where('is_parent','=',0)
            ->get();


        $data = [
            'approvalnumbers' => $approvalnumbers,
            'fishtypes' =>$fishtypes,
            'bagcolors'=>$bagcolors,
            'cartontypes'=>$cartontypes,
            'locations'=>$locations,
            'codemasters'=>$codemasters,
            'product'=>$product,
            'buyercode'=>$buyercode,
            'cm' => $cm
        ];

        return view('process::admin.products.edit')->with($data);
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
        
        //Update New Product
        $production = $this->product->updateProduct($request,$product);


        //Create New Carton
        $carton = app(CartonRepository::class)->createCarton($production,$request->all());

        //Add New Carton Loactaion
        $cartontLocation = app(CartonLocationRepository::class)->addCarton($carton);




        //Commented By umesh
//        //Find Carton
//        $carton = app(CartonRepository::class)->getByAttributes(['product_id' => $product->id ]);


        //Update Carton

//        if(count($carton) == 1)
//        {
//            $cartons = app(CartonRepository::class)->updateCarton($carton->first(),$request->all());
//
//            $cartontLocation = app(CartonLocationRepository::class)->updateCartonLocation($request->location_id,$cartons);
//        }
        
        //Update Carton Location
        //Add Product Codes
//        $codes = $request->input('code');
//        $production->codes()->sync($codes);

        return redirect()->route('admin.process.product.packingindex')
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function cartonDate(Request $request)
    {
        $products = $this->product->getByAttributes(['fish_type' => $request->id]);

        foreach ($products as $product)
        {
            $cartonDate[] = $product->carton_date;
        }
        return response()->json($cartonDate);
    }

    public function lotNumber(Request $request)
    {
        $products = $this->product->getByAttributes(['carton_date' => Carbon::parse($request->date)->format('Y-m-d')]);

        return response()->json($products);
    }

}
