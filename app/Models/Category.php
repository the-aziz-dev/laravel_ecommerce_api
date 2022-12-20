<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function storeCategory(Request $request)
    {
        $this->query()->create([
            'title' => $request->title,
            'parent_id' => $request->parent_id
        ]);
    }

    public function updateCategory(Request $request)
    {
        $this->update([
            'title' => $request->title,
            'parent_id' => $request->parent_id
        ]);
    }
}
