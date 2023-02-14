<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Item;
use App\Models\Category;
use App\Models\Unit;

use Illuminate\Support\Carbon;

class StockController extends Controller
{
    public function itemStockListPage(){
        $stock = Item::orderBy('id', 'desc')->get();
        $categories = Category::all();

        return view('stock.item_stock_list')->with([
            'stock' => $stock,
            'categories' => $categories
        ]);
    }

    public function almostEmptyPage(){
        $stock = Item::orderBy('id', 'desc')->get();

        return view('stock.almost_empty')->with([
            'stock' => $stock
        ]);
    }

    public function addStockPage(){
        $categories = Category::orderBy('id', 'desc')->get();
        $units = Unit::orderBy('id', 'desc')->get();
        return view('stock.add_stock')->with([
            'categories' => $categories,
            'units' => $units
        ]);
    }

    public function addStock(Request $request){
        $request->validate([
            'item_name' => 'required|unique:items,item_name',
            'category_id' => 'required',
            'total_stock' => 'required',
            'price' => 'required',
            'unit_id' => 'required'
        ],[
            'item_name.unique' => 'Item has already exist!',
            'category_id.required' => 'Category is required!',
            'unit_id.required' => 'Unit is required!',
        ]);

        Item::insert([
            'item_name' => $request->item_name,
            'category_id' => $request->category_id,
            'stock_left' => $request->total_stock,
            'price' => $request->price,
            'unit_id' => $request->unit_id,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Item added!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function editItemPage($id){
        $item = Item::find($id);
        $categories = Category::all();
        $units = Unit::all();

        return view('stock.edit_item')->with([
            'item' => $item,
            'categories' => $categories,
            'units' => $units
        ]);
    }

    public function editItem(Request $request){
        $item_id = $request->id;

        $request->validate([
            'item_name' => 'required',
            'category_id' => 'required',
            'total_stock' => 'required',
            'price' => 'required',
            'unit_id' => 'required'
        ],[
            'item_name.required' => 'Item name is required!',
            'category_id.required' => 'Category is required!',
            'unit_id.required' => 'Unit is required!',
        ]);

        Item::find($item_id)->update([
            'item_name' => $request->item_name,
            'category_id' => $request->category_id,
            'stock_left' => $request->total_stock,
            'price' => $request->price,
            'unit_id' => $request->unit_id
        ]);

        $notification = array(
            'message' => 'Item updated!',
            'alert-type' => 'success'
        );

        return redirect()->route('item.stock.list.page')->with($notification);
    }

    public function deleteItem($id){
        $item = Item::find($id);
        $item->delete();

        $notification = array(
            'message' => 'Item deleted!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
