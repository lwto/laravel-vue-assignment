<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categories(Request $request)
    {
        $categories = Category::orderBy('id', 'asc')->paginate($request->total);
        return response()->json(
            [
                'categories' => $categories,
                'message' => 'Categories',
                'code' => 200

            ]
        );
    }
    public function publish()
    {
        $categories = Category::all()->where('status', '1');
        return response()->json(
            [
                'categories' => $categories,
                'message' => 'Categories',
                'code' => 200

            ]
        );
    }
    public function store(Request $request)
    {
        $categories = new Category([
            'name' => $request->input('name'),
            'photo' => $request->input('photo'),
            'status' => $request->input('status'),

        ]);
        $categories->save();
        return response()->json('Category created!');
    }

    public function delete($id)
    {
        $categories = Category::find($id);
        if ($categories) {
            $categories->delete();
            return response()->json(
                [
                    'message' => 'Category Deleted',
                    'code' => 200

                ]
            );
        } else {
            return response()->json(
                [
                    'message' => 'Category with $id does not exit',

                ]
            );
        }
    }
}
