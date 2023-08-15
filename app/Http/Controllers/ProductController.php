<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Producer;
use App\Models\Product;
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
            return \response()->json(['message'=>'delete successfully']);
        }
        return \response()->json(['message'=>'some thing went wrong try again']);
    }
}
