<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Item;

class DefaultController extends Controller
{
    public function getItemCategory(Request $request){
        $category_id = $request->category_id;

        $item_category = Item::with(['category'])
                        ->select('id')
                        ->where('category_id', $category_id)
                        ->get();

        return response()->json($item_category);
    }
}
