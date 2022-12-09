<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function storeBrand($request)
    {
        Brand::query()->create([
            'title' => $request->title,
            'image' => $request->image
        ]);
    }

    public function updateBrand($request)
    {
        Brand::query()->update([
            'title' => $request->title,
            'image' => $request->image
        ]);
    }
}
