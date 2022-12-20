<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\BrandResource;
use App\Models\Brand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class BrandController extends Controller
{
    public function index(): JsonResponse
    {
        return self::successResponse(200, BrandResource::collection(Brand::all()));
    }


    public function store(Request $request, Brand $brand): JsonResponse
    {
        $validate = Validator::make($request->all(), [
            'title' => 'required|string|unique:brands,title',
            'image' => 'required|image'
        ]);

        if ($validate->fails()) {
            return self::failResponse(422, $validate->messages());
        }

        $brand->storeBrand($request);
        $dataResponse = Brand::query()->orderBy('id', 'desc')->first();
        return self::successResponse(201, new BrandResource($dataResponse));
    }


    public function show(Brand $brand): JsonResponse
    {
        return self::successResponse(200, new BrandResource($brand));
    }


    public function update(Request $request, Brand $brand): JsonResponse
    {
        $brandUnique = Brand::query()
            ->where('title', $request->title)
            ->where('id', '!=', $brand->id)->exists();

        if ($brandUnique) {
            return self::failResponse(422, 'The title has already been taken.');
        }

        $validate = Validator::make($request->all(), [
            'title' => 'required|string',
            'image' => 'image',
        ]);

        if ($validate->fails()) {
            return self::failResponse(422, $validate->messages());
        }

        $brand->updateBrand($request);
        return self::successResponse(200, new BrandResource($brand));
    }


    public function destroy(Brand $brand): JsonResponse
    {
        $brand->delete();
        return self::successResponse(200, new BrandResource($brand));
    }

}
