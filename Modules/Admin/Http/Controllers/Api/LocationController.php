<?php
/**
 * Created by PhpStorm.
 * User: accunity
 * Date: 15/7/17
 * Time: 12:23 PM
 */
namespace Modules\Admin\Http\Controllers\Api;

use App\Exceptions\ActionNotAllowedException;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Modules\Profile\Entities\Location;
use Modules\Profile\Repositories\LocationRepository;
use Modules\Profile\Repositories\CityRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\User\Contracts\Authentication;

class LocationController extends AdminBaseController
{
    /**
     * @var
     */
    private $location;
    /**
     * @var
     */
    private $auth;

    public function __construct(\Modules\Admin\Repositories\LocationRepository $location, Authentication $auth)
    {
        parent::__construct();

        $this->location = $location;
        $this->auth = $auth;
    }



    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = [
                'name' => $request->name,
                'location' => $request->location,
                'sublocation' => $request->sublocation,
                'details' => $request->details,
            ];
            $this->location->create($data);
            DB::commit();
            $location = $this->location;
            return response()->json(['success' => true, 'message' => 'Location Created Successfully.', 'location' => $location]);
        } catch (ActionNotAllowedException $ex) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => trans('core::errors.messages.ActionNOAllowed', ['operation' => 'create location']), 'location' => $location]);
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['success' => false, 'message' => trans('core::errors.messages.something went wrong', ['operation' => 'creating location'])], 500);
        }
    }

}