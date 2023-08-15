<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProducerRequest;
use App\Http\Requests\UpdateProducerRequest;
use App\Http\Resources\ProducerResource;
use App\Models\Producer;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ProducerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return ProducerResource::collection(Producer::all());
    }

    /**
     * Display the specified resource.
     *
     * @param Producer $producer
     * @return Response
     */
    public function show(Producer $producer)
    {
        return ProducerResource::make($producer);
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
     * @param \App\Http\Requests\StoreProducerRequest $request
     * @return Response
     */
    public function store(StoreProducerRequest $request)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Producer $producer
     * @return Response
     */
    public function edit(Producer $producer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateProducerRequest $request
     * @param Producer $producer
     * @return Response
     */
    public function update(UpdateProducerRequest $request, Producer $producer)
    {
        //
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
