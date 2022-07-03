<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStoreRequest;
use App\Http\Requests\UpdateStoreRequest;
use App\Http\Resources\MerchantStoreDetailsResource;
use App\Models\MerchantStoreValue;
use App\Models\Store;
use App\Models\StoreAttribute;
use Illuminate\Support\Facades\DB;

class MerchantStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores = auth()->user()->stores;

        return response()->json([
            'status' => true,
            'message' => 'My stores',
            'data' => MerchantStoreDetailsResource::collection($stores->loadMissing('details.attribute'))
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStoreRequest $request)
    {
        $stoteRequiredAttributes = StoreAttribute::get();

        foreach ($stoteRequiredAttributes as $attribute) {
            $reuired = $attribute->is_required ? '|required' : '';
            $stoteRequiredAttributesArray['details.' . $attribute->name] = "$attribute->type" . "$reuired";
        }

        $request->validate($stoteRequiredAttributesArray);

        try {
            DB::beginTransaction();

            $store = Store::create([
                'merchant_id' => auth()->user()->id,
                'name' => $request->name,
            ]);

            foreach ($stoteRequiredAttributes as $attribute) {
                if (isset($request->details[$attribute->name])) {
                    $store->details()->create([
                        'store_id' => $store->id,
                        'store_attribute_id' => $attribute->id,
                        'value' => $request->details[$attribute->name],
                    ]);
                }
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            // throw $e;
            return response()->json([
                'status' => false,
                'message' => 'Error while creating store',
                'data' => [
                    'error' => $e->getMessage()
                ]
            ], 500);
        }

        return response()->json([
            'status' => true,
            'message' => 'Store created',
            'data' => new MerchantStoreDetailsResource($store->loadMissing('details.attribute'))
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        $store = Store::query()
            ->with([
                'details.attribute'
            ])
            ->first();

        return response()->json([
            'status' => true,
            'message' => 'Store data',
            'data' => new MerchantStoreDetailsResource($store->loadMissing('details.attribute'))
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStoreRequest  $request
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStoreRequest $request, Store $store)
    {
        $stoteRequiredAttributes = StoreAttribute::get();

        foreach ($stoteRequiredAttributes as $attribute) {
            $reuired = $attribute->is_required ? '|required' : '';
            $stoteRequiredAttributesArray['details.' . $attribute->name] = "$attribute->type" . "$reuired";
        }

        $request->validate($stoteRequiredAttributesArray);

        $store->update($request->validated());

        if ($request->details) {
            foreach ($stoteRequiredAttributes as $attribute) {
                if (isset($request->details[$attribute->name])) {
                    MerchantStoreValue::updateOrCreate([
                        'store_id' => $store->id,
                        'store_attribute_id' => $attribute->id
                    ], [
                        'value' => $request->details[$attribute->name],
                    ]);
                }
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Store updated',
            'data' => new MerchantStoreDetailsResource($store->loadMissing('details.attribute'))
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        $store->delete();

        return response()->json([
            'status' => true,
            'message' => 'Store deleted'
        ]);
    }
}
