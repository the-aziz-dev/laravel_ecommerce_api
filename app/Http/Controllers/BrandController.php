<?php

namespace App\Http\Controllers;

use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class BrandController extends Controller
{
    public function index(): JsonResponse
    {
        return self::successResponse(200, BrandResource::collection(Brand::all()));
    }


    public function store(Request $request, Brand $brand): JsonResponse
    {
        $brand->storeBrand($request);
        $dataResponse = Brand::query()
            ->orderBy('id', 'desc')
            ->first();
        return self::successResponse(201, new BrandResource($dataResponse));
    }


    public function show(Brand $brand): JsonResponse
    {
        return self::successResponse(200, new BrandResource($brand));
    }


    public function update(Request $request, Brand $brand): JsonResponse
    {
        $brand->updateBrand($request);
        return self::successResponse(200, new BrandResource($brand));
    }


    public function destroy(Brand $brand): JsonResponse
    {
        $brand->delete();
        return self::successResponse(200, new BrandResource($brand));
    }

}
