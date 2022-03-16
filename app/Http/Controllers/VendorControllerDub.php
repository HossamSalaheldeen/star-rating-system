<?php

namespace App\Http\Controllers\Settings;

use App\Models\BusinessUnit;
use App\Models\Enterprise;
use App\Models\Market;
use App\Models\Vendor;
use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\VendorRequest;
use App\Services\Vendors\DeleteVendorService;
use App\Services\Vendors\MapVendorsTableData;
use App\Services\Vendors\GetAllowedVendorActionsService;
use App\Services\Vendors\GetAllVendorsService;
use App\Services\Vendors\GetVendorsTableColumnsService;
use App\Services\Vendors\StoreVendorService;
use App\Services\Vendors\ToggleVendorActiveService;
use App\Services\Vendors\UpdateVendorService;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseCode;

class VendorController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Vendor::class);
    }

    protected function resourceAbilityMap()
    {
        $abilities         = parent::resourceAbilityMap();
        $abilities['edit'] = 'edit';
        return $abilities;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param GetAllowedVendorActionsService $getAllowedVendorActionsService
     * @param MapVendorsTableData $mapVendorsTableData
     * @param GetAllVendorsService $getAllVendorsService
     * @param GetVendorsTableColumnsService $getVendorsTableColumnsService
     * @return Factory|View
     */
    public function index(
        Request $request,
        GetAllowedVendorActionsService $getAllowedVendorActionsService,
        MapVendorsTableData $mapVendorsTableData,
        GetAllVendorsService $getAllVendorsService,
        GetVendorsTableColumnsService $getVendorsTableColumnsService
    )
    {
        $filterData = $request->only('name', 'enterprise', 'market', 'active');

        if (!auth()->user()->isOwner()) {
            $filterData['enterprise'] = auth()->user()->department->enterprise_id;
        }

        $vendors = $getAllVendorsService->handle(customCollect([
            'filterData'       => $filterData,
            'perPagePaginator' => self::$perPagePaginator,
            'query'            => $request->query(),
            'withRelations'    => [
                'city.country:id,name',
                'market.enterprise:id,name',
                'personOfContacts:id,name,email,phone,vendor_id',
            ]
        ]));

        $data = $mapVendorsTableData->handle(customCollect(compact('vendors')));

        //   dd($data);
        $actions      = $getAllowedVendorActionsService->handle(customCollect(['user' => \Auth::user()]));
        $fields       = $getVendorsTableColumnsService->handle();
        $enterprise   = Enterprise::find($request->enterprise,['id','name']);
        $businessUnit = BusinessUnit::find($request->business_unit,['id','name']);
        $market       = Market::find($request->market,['id','name']);

        if ($request->ajax())
            return view('layout.body.content', get_defined_vars() + ['resource' => 'vendors']);

        return view('settings.vendors.index', get_defined_vars() + ['resource' => 'vendors']);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('settings.vendors.create', ['vendor' => new Vendor()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param VendorRequest $request
     * @param StoreVendorService $storeVendorService
     * @return ResponseFactory|Response
     */
    public function store(VendorRequest $request, StoreVendorService $storeVendorService)
    {

        $vendorData = $request->only([
            'name', 'email', 'vat_number', 'address',
            'names', 'emails', 'phones',
            'city_id', 'market_id', 'is_active',
        ]);

        $vendorData['is_active'] = true;

        $storeVendorService->handle(customCollect([
            'vendorData' => $vendorData
        ]));

        return $this->jsonSuccessResponse([
            'redirect' => route('settings.vendors.index'),
        ], __('vendors.created'), ResponseCode::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Vendor $vendor
     * @return Application|Factory|View|Response
     */
    public function show(Vendor $vendor)
    {
        return view('settings.vendors.modals.show-modal', compact('vendor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Vendor $vendor
     * @return Application|Factory|View|Response
     */
    public function edit(Vendor $vendor)
    {
//        dd($vendor->hasRelatedEntities())
        $vendor = Vendor::with(['personOfContacts','city.country','market.enterprise'])->find($vendor->id);
        return view('settings.vendors.edit', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param VendorRequest $request
     * @param UpdateVendorService $updateVendorService
     * @param Vendor $vendor
     * @return ResponseFactory|Response
     */
    public function update(VendorRequest $request, UpdateVendorService $updateVendorService, Vendor $vendor)
    {

        $data = $request->only([
            'name', 'email', 'vat_number', 'address',
            'names', 'emails', 'phones',
            'city_id', 'market_id', 'is_active',
        ]);

        $updateVendorService->handle(customCollect([
            'vendor'     => $vendor,
            'vendorData' => $data,
        ]));

        return $this->jsonSuccessResponse([
            'redirect' => route('settings.vendors.index'),
        ], __('vendors.updated'), ResponseCode::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteVendorService $deleteVendorService
     * @param Vendor $vendor
     * @return ResponseFactory|Response
     */
    public function destroy(DeleteVendorService $deleteVendorService, Vendor $vendor)
    {
        $deleteVendorService->handle(customCollect([
            'vendor' => $vendor,
        ]));

        return $this->jsonSuccessResponse([], __('vendors.deleted'), ResponseCode::HTTP_ACCEPTED);
    }

    public function toggleActive(Vendor $vendor, ToggleVendorActiveService $toggleVendorActiveService)
    {
        //        $this->authorize('toggleActive',$vendor);
        $toggleVendorActiveService->handle(customCollect(compact('vendor')));
        return $this->jsonSuccessResponse([], __('vendors.activation_changed'), ResponseCode::HTTP_ACCEPTED);
    }
}
