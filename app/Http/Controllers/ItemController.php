<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function items()
    {
        $items = Item::all();
        return response()->json(
            [
                'items' => $items,
                'message' => 'Items',
                'code' => 200

            ]
        );
    }
    public function store(Request $request)
    {
        $items = new Item([
            'item_name' => $request->input('item_name'),
            'category' => $request->input('category'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'condition' => $request->input('condition'),
            'type' => $request->input('type'),
            'status' => $request->input('status'),
            'photo' => $request->input('photo'),
            'owner_name' => $request->input('owner_name'),
            'contact' => $request->input('contact'),
            'address' => $request->input('address'),


        ]);
        $items->save();
        return response()->json('Item created!');
    }

    public function delete($id)
    {
        $items = Item::find($id);
        if ($items) {
            $items->delete();
            return response()->json(
                [
                    'message' => 'Item Deleted',
                    'code' => 200

                ]
            );
        } else {
            return response()->json(
                [
                    'message' => 'Item does not exit',

                ]
            );
        }
    }
}
