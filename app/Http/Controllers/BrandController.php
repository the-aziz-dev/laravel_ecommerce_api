<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class BrandController extends Controller
{

    public function index(): JsonResponse
    {
        return $this->successResponse(
            200, 'Brands retrieved successfully.', Brand::all());
    }


    public function store(Request $request): JsonResponse
    {
        Brand::query()->create([
            'title' => $request->title,
            'image' => $request->image
        ]);

        $dataResponse = Brand::query()->orderBy('id', 'desc')->first();
        return $this->successResponse(
            201, 'Brand created successfully.', $dataResponse);
    }


    public function show(Brand $brand): JsonResponse
    {
        return $this->successResponse(
            201, 'Brand retrieved successfully.', $brand);
    }


    public function update(Request $request, Brand $brand): JsonResponse
    {
        Brand::query()->update([
            'title' => $request->title,
            'image' => $request->image
        ]);

        return $this->successResponse(
            200, 'Brand updated successfully.', $brand);
    }


    public function destroy(Brand $brand): JsonResponse
    {
        $brand->delete();
        return $this->successResponse(
            200, 'Brand deleted successfully', $brand);
    }
}
