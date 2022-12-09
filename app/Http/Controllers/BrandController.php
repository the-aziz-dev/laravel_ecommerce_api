<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class BrandController extends Controller
{
    public function index(): JsonResponse
    {
        return self::successResponse(200, Brand::all());
    }


    public function store(Request $request, Brand $brand): JsonResponse
    {
        $brand->storeBrand($request);
        $dataResponse = Brand::query()
            ->orderBy('id', 'desc')
            ->first();
        return self::successResponse(201, $dataResponse);
    }


    public function show(Brand $brand): JsonResponse
    {
        return self::successResponse(200, $brand);
    }


    public function update(Request $request, Brand $brand): JsonResponse
    {
        $brand->updateBrand($request);
        return self::successResponse(200, $brand);
    }


    public function destroy(Brand $brand): JsonResponse
    {
        $brand->delete();
        return self::successResponse(200, $brand);
    }


}
