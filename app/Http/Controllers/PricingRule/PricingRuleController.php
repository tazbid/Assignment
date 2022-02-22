<?php

namespace App\Http\Controllers\PricingRule;

use App\Http\Controllers\Controller;
use App\Http\Requests\PricingRule\GetPricingRuleDetailsRequestAPI;
use App\Http\Requests\PricingRule\PricingRuleInsertAjaxRequest;
use App\Http\Requests\PricingRule\PricingRuleUpdateAjaxRequest;
use App\Http\Resources\PricingRule\PricingRuleResource;
use App\Models\DeliveryRoute\DeliveryRouteModel;
use App\Models\DeliveryType\DeliveryTypeModel;
use App\Models\PricingRule\PricingRuleModel;
use App\Models\Weight\WeightModel;
use App\Services\PricingRule\PricingRuleService;
use App\Traits\UserTrait;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Response;


class PricingRuleController extends Controller {
    //
    use UserTrait;

    private $pricingRuleService;

    public function __construct(PricingRuleService $pricingRuleService) {
        $this->pricingRuleService = $pricingRuleService;
    }

    /**
     * @name getAllPricingRules
     * @role all pricing rule view
     * @param null
     * @return view
     *
     */
    public function getAllPricingRules() {
        return view('admin.pricingRule.pricingRules');
    }

    /**
     * @name getpPicingRuleDetails
     * @role pricing rule details view
     * @param $id
     * @return view
     *
     */
    public function getpPicingRuleDetails($id) {
        $pricingRule = PricingRuleModel::with('weightDetails', 'deliveryRouteDetails', 'deliveryTypeDetails')
            ->find($id);
        if (!$pricingRule) {
            abort(404);
        }

        $data = [
            'pricingRule'          => $pricingRule,
            'weightDetails'        => $pricingRule->weightDetails,
            'deliveryRouteDetails' => $pricingRule->deliveryRouteDetails,
            'deliveryTypeDetails'  => $pricingRule->deliveryTypeDetails,
        ];
        return view('admin.pricingRule.pricingRuleDetails', $data);
    }

    /**
     * @name pricingRuleInsertView
     * @role pricing rule insert view
     * @param null
     * @return view
     *
     */
    public function pricingRuleInsertView() {
        $weights        = WeightModel::all();
        $deliveryRoutes = DeliveryRouteModel::all();
        $deliveryTypes  = DeliveryTypeModel::all();
        $data           = [
            'weights'        => $weights,
            'deliveryRoutes' => $deliveryRoutes,
            'deliveryTypes'  => $deliveryTypes,
        ];
        return view("admin.pricingRule.pricingRuleInsert", $data);
    }

    /**
     * @name pricingRuleEditView
     * @role pricing rule edit view
     * @param \Illuminate\Http\Request  $request
     * @return view
     *
     */
    public function pricingRuleEditView(Request $request) {
        $pricingRule = PricingRuleModel::find($request->id);
        if (!$pricingRule) {
            abort(404);
        }
        $weights        = WeightModel::all();
        $deliveryRoutes = DeliveryRouteModel::all();
        $deliveryTypes  = DeliveryTypeModel::all();
        $data           = [
            'pricingRule'    => $pricingRule,
            'weights'        => $weights,
            'deliveryRoutes' => $deliveryRoutes,
            'deliveryTypes'  => $deliveryTypes,
        ];
        return view("admin.pricingRule.pricingRuleEdit", $data);
    }

    /**
     * @name getpricingRuleDataTableAjax
     * @role send datatable json for showing pricing rules
     * @param null
     * @return  Datatable json
     *
     */
    public function getpricingRuleDataTableAjax() {
        $pricingRules = PricingRuleModel::with('weightDetails', 'deliveryRouteDetails', 'deliveryTypeDetails')
            ->get();
        return Datatables::of($pricingRules)
            ->addIndexColumn()
            ->addColumn('weight_name', function ($pricingRule) {
                return ($pricingRule->weightDetails->weight_name);
            })
            ->addColumn('delivery_route_name', function ($pricingRule) {
                return ($pricingRule->deliveryRouteDetails->delivery_route_name);
            })
            ->addColumn('delivery_type_name', function ($pricingRule) {
                return ($pricingRule->deliveryTypeDetails->delivery_type_name);
            })
            ->addColumn('expiration_date', function ($pricingRule) {
                $expirationDate = Carbon::parse($pricingRule->expiration_date);
                return date_format($expirationDate, 'D, d M Y');
            })
            ->addColumn('action', function ($pricingRule) {
                $updateUrl         = url('admin/pricing/rule/edit', [$pricingRule->id]);
                $pricingRuleDetils = url('admin/pricing/rule/details', [$pricingRule->id]);

                $markup = '';

                $markup .= ' <a href="' . $updateUrl . '" class="btn btn-sm btn-info"
                data-toggle="tooltip" data-placement="top" title="Edit Pricing Rule"><i
                class="fa fa-pencil" aria-hidden="true"></i></a>';

                $markup .= ' <a href="' . $pricingRuleDetils . '" class="btn btn-sm btn-info"
                data-toggle="tooltip" data-placement="top" title="Pricing Rule Details"><i
                class="fa fa-eye" aria-hidden="true"></i></a>';

                $markup .= ' <button class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete"
                onclick="deletePricingRule(' . $pricingRule->id . ')"><i
                class="fa fa-trash-o" aria-hidden="true"></i></button>';

                return $markup;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * @name pricingRuleInsertAjax
     * @role insert a pricing rule record into database
     * @param \App\Http\Requests\PricingRule\PricingRuleInsertAjaxRequest $request
     * @return  Json response
     *
     * @throws Illuminate\Validation\ValidationException
     */
    public function pricingRuleInsertAjax(PricingRuleInsertAjaxRequest $request) {
        $pricingRule = PricingRuleModel::where('weight_id', $request->weight_id)
            ->where('delivery_route_id', $request->delivery_route_id)
            ->where('delivery_type_id', $request->delivery_type_id)
            ->where('status', $this->active)
            ->first();
        if ($pricingRule) {
            return response()->json(array('errors' => "Pricing rule already exists!"), 409);
        }
        //insert
        $insertResponse = $this->pricingRuleService->insertPricingRule($request);

        if ($insertResponse) {
            return new JsonResponse([], 201);
        } else {
            return response()->json(array('errors' => "Something Went Wrong"), 500);
        }
    }

    /**
     * @name weightUpdateAjax
     * @role update a pricing rule record into database
     * @param \App\Http\Requests\PricingRule\PricingRuleUpdateAjaxRequest $request
     * @return  Json response
     *
     * @throws Illuminate\Validation\ValidationException
     */
    public function pricingRuleUpdateAjax(PricingRuleUpdateAjaxRequest $request) {
        $checkPricingRule = PricingRuleModel::where('weight_id', $request->weight_id)
            ->where('delivery_route_id', $request->delivery_route_id)
            ->where('delivery_type_id', $request->delivery_type_id)
            ->where('status', $this->active)
            ->first();
        if ($checkPricingRule) {
            if ($checkPricingRule->id != $request->id) {
                return response()->json(array('errors' => "Pricing rule already exists!"), 409);
            }
        }
        $pricingRule = PricingRuleModel::find($request->id);
        if (!$pricingRule) {
            abort(404);
        }
        $updateResponse = $this->pricingRuleService->updatePricingRule($request, $pricingRule);
        if ($updateResponse) {
            return new JsonResponse([], 200);
        } else {
            return response()->json(array('errors' => "Something Went Wrong"), 500);
        }
    }

    /**
     * @name pricingRuleDeleteAjax
     * @role delete a pricing rule record from database
     * @param Request $request
     * @return  Json response
     *
     * @throws Illuminate\Validation\ValidationException
     */
    public function pricingRuleDeleteAjax(Request $request) {
        $pricingRule = PricingRuleModel::find($request->id);
        if (!$pricingRule) {
            abort(404);
        }

        $deleteResponse = $this->pricingRuleService->deletePricingRule($pricingRule);
        if ($deleteResponse) {
            return new JsonResponse([], 204);
        } else {
            return response()->json(array('errors' => "Something Went Wrong"), 500);
        }
    }
    /**
     * @name getPricingRuleDetails
     * @role get pricing rule details
     * @param \App\Http\Requests\PricingRule\GetPricingRuleDetailsRequestAPI $request
     * @return  Json response
     *
     * @throws Illuminate\Validation\ValidationException
     */
    public function getPricingRuleDetails(GetPricingRuleDetailsRequestAPI $request) {
        try{
            $pricingRule = $this->pricingRuleService->getPricingRuleDetails($request);
            return PricingRuleResource::make($pricingRule)->additional(
                [
                    'success'=>true,
                    'message'=>'Pricing Rule details fetched successfully'
                ]
            );
        } catch (\Throwable $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
