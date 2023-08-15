<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
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
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreProductRequest $request
     * @return Response
     */
    public function store(StoreProductRequest $request)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateProductRequest $request
     * @param Product $product
     * @return Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
