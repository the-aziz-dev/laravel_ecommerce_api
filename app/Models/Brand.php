<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function storeBrand($request)
    {
        $imageName = Carbon::now()->microsecond . '.' . $request->image->extension();
        $request->image->storeAs('images/brands', $imageName, 'public');

        Brand::query()->create([
            'title' => $request->title,
            'image' => $imageName
        ]);
    }

    public function updateBrand($request)
    {
        $imageName = null;
        if ($request->has('image')) {
            $imageName = Carbon::now()->microsecond . '.' . $request->image->extension();
            $request->image->storeAs('images/brands', $imageName, 'public');
        }

        Brand::query()->update([
            'title' => $request->title,
            'image' => $request->has('image') ? $imageName : $this->image,
        ]);
    }
}
