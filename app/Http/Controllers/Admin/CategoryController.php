<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{

    public function index(): JsonResponse
    {
        return self::successResponse(200, CategoryResource::collection(Category::all()));
    }

    public function store(Request $request, Category $category): JsonResponse
    {
        $validate = Validator::make($request->all(), [
            'title' => 'required|String|unique:categories,title',
            'parent_id' => 'nullable|integer'
        ]);
        if ($validate->fails()) {
            return self::failResponse(422, $validate->messages());
        }
        $category->storeCategory($request);
        $storedCategory = $category->query()->orderBy('id', 'desc')->first();
        return self::successResponse(201, new CategoryResource($storedCategory));
    }

    public function show(Category $category): JsonResponse
    {
        return self::successResponse(200, new CategoryResource($category));
    }

    public function update(Request $request, Category $category): JsonResponse
    {
        $categoryUnique = Category::query()
            ->where('title', $request->title)
            ->where('id', '!=', $category->id)->exists();
        if ($categoryUnique) {
            return self::failResponse(422, 'The category has already been taken');
        }
        $validate = Validator::make($request->all(), [
            'title' => 'required|string',
            'parent_id' => 'nullable|integer'
        ]);
        if ($validate->fails()) {
            return self::failResponse(422, $validate->messages());
        }
        $category->updateCategory($request);
        return self::successResponse(200, new CategoryResource($category));
    }

    public function destroy(Category $category): JsonResponse
    {
        $category->delete();
        return self::successResponse(200, new CategoryResource($category));
    }

    public function parent(Category $category): JsonResponse
    {
        return self::successResponse(200, new CategoryResource($category->load('parent')));
    }

    public function children(Category $category): JsonResponse
    {
        return self::successResponse(200, new CategoryResource($category->load('children')));
    }
}
