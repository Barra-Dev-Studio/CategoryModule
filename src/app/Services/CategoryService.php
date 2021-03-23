<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryService
{

    public function get($id)
    {
        return Category::where('id', $id)->first();
    }

    public function getAll()
    {
        return Category::orderby('name', 'asc')->get();
    }

    public function store(Request $request)
    {
        return Category::create(
            [
                'name' => $request->name
            ]
        );
    }

    public function update(Request $request, $id)
    {
        return Category::where('id', $id)->update(
            [
                'name' => $request->name
            ]
        );
    }

    public function delete($id)
    {
        return Category::where('id', $id)->delete();
    }
}
