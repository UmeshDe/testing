<?php

namespace Modules\Process\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Modules\Admin\Repositories\ApprovalNumberRepository;
use Modules\Admin\Repositories\BagcolorRepository;
use Modules\Admin\Repositories\BuyercodeRepository;
use Modules\Admin\Repositories\CartonTypeRepository;
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
        $products = $this->product->all();
        return view('process::admin.products.index', compact('products'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function packingindex()
    {
        $products = $this->product->all();
        return view('process::admin.products.packingindex', compact('products'));
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
            'product'=>$product
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
                ->get();
        
        $fr = $codeMasterRepo->allWithBuilder()
                ->where('is_parent' ,'=',2)
                ->get();
        
        $d = $codeMasterRepo->allWithBuilder()
                ->where('is_parent','=',3)
                ->get();
        
        $s = $codeMasterRepo->allWithBuilder()
                ->where('is_parent' ,'=',4)
                ->get();
        
        $a = $codeMasterRepo->allWithBuilder()
                ->where('is_parent','=',5)
                ->get();
        
        $c = $codeMasterRepo->allWithBuilder()
                ->where('is_parent' ,'=' ,6)
                ->get();
        
        $p= $codeMasterRepo->allWithBuilder()
                ->where('is_parent','=',7)
                ->get();
        
        $b= $codeMasterRepo->allWithBuilder()
                ->where('is_parent','=',8)
                ->get();
        
        $m = $codeMasterRepo->allWithBuilder()
                ->where('is_parent','=',9)
                ->get();

        $w = $codeMasterRepo->allWithBuilder()
                ->where('is_parent','=',10)
                ->get();

        $q = $codeMasterRepo->allWithBuilder()
                ->where('is_parent','=',11)
                ->get();

        $sc = $codeMasterRepo->allWithBuilder()
                ->where('is_parent','=',12)
                ->get();

        $lc = $codeMasterRepo->allWithBuilder()
                ->where('is_parent','=',13)
                ->get();
            
        
        
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
            'lc' => $lc
        ];
        
        
//        $codemasters = $codeMasterRepo->allWithBuilder()
//            ->with('childCodes')
//            ->where('is_parent','=',0)
//            ->get();

        $product = new Product();

        return view('process::admin.products.create', compact('codemasters', 'fishtypes', 'bagcolors', 'codemaster', 'multiplecodes', 'cartontypes', 'locations', 'approvalnumbers','product','buyercode','codes'))->with($codes);
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
            'buyercode'=>$buyercode
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
}
