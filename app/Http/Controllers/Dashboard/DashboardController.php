<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\DeliveryRoute\DeliveryRouteModel;
use App\Models\DeliveryType\DeliveryTypeModel;
use App\Models\Patient\PatientModel;
use App\Models\PricingRule\PricingRuleModel;
use App\Models\User;use App\Models\Weight\WeightModel;
use App\Traits\UserTrait;use Arcanedev\LogViewer\Contracts\LogViewer as LogViewerContract;

use Arcanedev\LogViewer\Exceptions\LogNotFoundException;

use Illuminate\Support\Arr;

use Illuminate\Support\Facades\Log;

use Illuminate\Support\Str;

class DashboardController extends Controller {

    use UserTrait;
    /* -----------------------------------------------------------------
    |  Properties
    | -----------------------------------------------------------------
     */

    /**
     * The log viewer instance
     *
     * @var \Arcanedev\LogViewer\Contracts\LogViewer
     */
    protected $logViewer;

    /** @var int */
    protected $perPage = 30;

    /** @var loglevel */
    protected $alert     = 'alert';
    protected $emergency = 'emergency';
    protected $critical  = 'critical';
    protected $warning   = 'warning';

    /**
     * DashboardController constructor.
     *
     * @param  \Arcanedev\LogViewer\Contracts\LogViewer  $logViewer
     */
    public function __construct(LogViewerContract $logViewer) {
        $this->logViewer = $logViewer;
    }

    /**
     * Get a log or fail
     *
     * @param  string  $date
     *
     * @return \Arcanedev\LogViewer\Entities\Log|null
     */
    protected function getLogOrFail($date) {
        $log = null;

        try {
            $log = $this->logViewer->get($date);
        } catch (LogNotFoundException $e) {
            //abort(404, $e->getMessage());
        }

        return $log;
    }

    /**
     * @name index
     * @role Dashboard view of controller
     * @param
     * @return  view with compact array
     *
     */
    public function index() {
        $superAdmins    = user::role($this->superAdminRole)->count();
        $weights        = WeightModel::count();
        $deliveryRoutes = DeliveryRouteModel::count();
        $deliveryTypes  = DeliveryTypeModel::count();
        $pricingRules = PricingRuleModel::count();

        $data = [
            'superAdmins'    => $superAdmins,
            'weights'        => $weights,
            'deliveryRoutes' => $deliveryRoutes,
            'deliveryTypes'  => $deliveryTypes,
            'pricingRules'   => $pricingRules,
        ];


        $data['today'] = date('D, F j');
        return view('admin.dashboard.index', $data);
    }
}
