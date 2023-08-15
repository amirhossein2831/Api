<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $includeProduct = $request->query('includeProduct');
        $companies = $includeProduct ? Company::with('products')->paginate(5) : Company::paginate(5);
        return CompanyResource::collection($companies->appends($request->query()));
    }

    /**
     * Display the specified resource.
     *
     * @param Company $company
     * @param Request $request
     * @return Response
     */
    public function show(Company $company, Request $request)
    {
        $includeProduct = $request->query('includeProduct');
        $company = $includeProduct ? $company->loadMissing('products') : $company;
        return CompanyResource::make($company);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCompanyRequest $request
     * @return void
     */
    public function store(StoreCompanyRequest $request)
    {
        return Company::create($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCompanyRequest $request
     * @param Company $company
     * @return JsonResponse
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        if ($company->update($request->all())) {
            return \response()->json(['message'=>'update successfully']);
        }
        return \response()->json(['message'=>'some thing went wrong try again']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     * @return JsonResponse
     */
    public function destroy(Company $company)
    {
        if ($company->delete()) {
            return \response()->json(['message' => 'delete successfully']);
        }
        return \response()->json(['message' => 'some thing went wrong try again']);
    }
}
