<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Producer;
use App\Models\Product;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $includeProducer = $request->query('includeProducer');
        $products = $includeProducer ? Product::with('producers')->paginate(10) : Product::paginate(10);
        return ProductResource::collection($products->appends($request->query()));
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @param Request $request
     * @return Response
     */
    public function show(Product $product, Request $request)
    {
        $includeProducer = $request->query('includeProducer');
        $product = $includeProducer ? $product->loadMissing('producers') : $product;
        return ProductResource::make($product);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRequest $request
     * @return JsonResponse
     */
    public function store(StoreProductRequest $request)
    {
        return Product::create($request->all());
    }

    /**
     * Add Producer to Product
     *
     * @param Product $product
     * @param Request $request
     * @return JsonResponse
     */
    public function addProducer(Product $product, Request $request)
    {
        $detail = [];
        $producerIds = $request->input('producerIds');
        foreach ($producerIds as $producerId) {
            if (!$product->producers()->where('producer_id', $producerId)->exists()) {
                try {
                    $producer = Producer::findOrFail($producerId);
                    $product->producers()->attach($producer);
                    $detail[] = ["the Producer with id = $producerId add to Product successfully"];
                } catch (Exception $exception) {
                    $detail[] = ["the Producer with id = $producerId does Not exist"];
                }
            } else
                $detail[] = ["the Producer with id = $producerId already added"];
        }
        return \response()->json($detail);
    }

    /**
     * remove Producer from product
     *
     * @param Product $product
     * @param Request $request
     * @return JsonResponse
     */
    public function removeProducer(Product $product, Request $request)
    {
        $detail = [];
        $producerIds = $request->input('producerIds');
        foreach ($producerIds as $producerId) {
            if ($product->producers()->where('producer_id', $producerId)->exists()) {
                $producer = Producer::findOrFail($producerId);
                $product->producers()->detach($producer);
                $detail[] = ["The Producer with id = $producerId delete successfully from the Product"];
            } else
                $detail[] = ["The Producer with id = $producerId  does not find in the Producer of this Product"];
        }
        return \response()->json($detail);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return JsonResponse
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        if ($product->update($request->all())) {
            return \response()->json(['message' => 'update successfully']);
        }
        return \response()->json(['message' => 'some thing went wrong try again']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product)
    {
        if ($product->delete()) {
            return \response()->json(['message' => 'delete successfully']);
        }
        return \response()->json(['message' => 'some thing went wrong try again']);
    }
}
