<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;

class Settings extends Controller
{
    public function CategoryList(Request $request)
    {
        $data = Category::where('status','=','Active')->orderBy('category')->get();
        return response()->json(['data' => $data,'code' => 200],200);
    }

    public function ItemList(Request $request)
    {
        $search     = $request->search;
        $category   = $request->category;
        $data       = Item::where('status','=','Active')->orderBy('item')->get();
        if($category !="")
        {
            if($search=="")
            {
                $data   = Item::where('status','=','Active')->where('category','=',$category)->orderBy('item')->get();
            }
            else
            {
                $data   = Item::where('status','=','Active')->where('category','=',$category)->where('item','LIKE','%'.$search.'%')->orderBy('item')->get();
            }
        }
        else
        {
            if($search=="")
            {
                $data   = Item::where('status','=','Active')->orderBy('item')->get();
            }
            else
            {
                $data   = Item::where('status','=','Active')->where('item','LIKE','%'.$search.'%')->orderBy('item')->get();
            }
        }
        return response()->json(['data' => $data,'code' => 200],200);
    }
}
