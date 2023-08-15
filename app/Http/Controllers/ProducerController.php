<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProducerRequest;
use App\Http\Requests\UpdateProducerRequest;
use App\Http\Resources\ProducerResource;
use App\Models\Producer;
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
     * @return Response
     */
    public function destroy(Producer $producer)
    {
        //
    }
}
