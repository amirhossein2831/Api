<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProducerRequest;
use App\Http\Requests\UpdateProducerRequest;
use App\Http\Resources\ProducerResource;
use App\Models\Producer;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ProducerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $includeProduct = $request->query('includeProduct');
        $producers = $includeProduct ? Producer::with('products')->paginate(20) : Producer::paginate(20);
        return ProducerResource::collection($producers->appends($request->query()));
    }

    /**
     * Display the specified resource.
     *
     * @param Producer $producer
     * @param Request $request
     * @return Response
     */
    public function show(Producer $producer, Request $request)
    {
        $includeProduct = $request->query('includeProduct');
        $producer = $includeProduct ? $producer->loadMissing('products') : $producer;
        return ProducerResource::make($producer);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProducerRequest $request
     * @return void
     */
    public function store(StoreProducerRequest $request)
    {
        return Producer::create($request->all());
    }

    /**
     * Add Product to Producer
     *
     * @param Producer $producer
     * @param Request $request
     * @return void
     */
    public function addProduct(Producer $producer, Request $request)
    {
        $productIds = $request->input('productIds');
        foreach ($productIds as $productId) {
            if (!$producer->products()->where('product_id', $productId)->exists()) {
                $product = Product::findOrFail($productId);
                $producer->products()->attach($product);
            }
        }
        return ProducerResource::make($producer->loadMissing('products'));
    }

    /**
     * Remove Product From Producer
     *
     * @param Producer $producer
     * @param Request $request
     * @return void
     */
    public function removeProduct(Producer $producer, Request $request)
    {
        $productIds = $request->input('productIds');
        foreach ($productIds as $productId) {
            if ($producer->products()->where('product_id', $productId)->exists()) {
                $product = Product::findOrFail($productId);
                $producer->products()->detach($product);
            }
        }
        return ProducerResource::make($producer->loadMissing('products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProducerRequest $request
     * @param Producer $producer
     * @return JsonResponse
     */
    public function update(UpdateProducerRequest $request, Producer $producer)
    {
        if ($producer->update($request->all())) {
            return \response()->json(['message' => 'update successfully']);
        }
        return \response()->json(['message' => 'some thing went wrong try again']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Producer $producer
     * @return JsonResponse
     */
    public function destroy(Producer $producer)
    {
        if ($producer->delete()) {
            return \response()->json(['message' => 'delete successfully']);
        }
        return \response()->json(['message' => 'some thing went wrong try again']);
    }
}
