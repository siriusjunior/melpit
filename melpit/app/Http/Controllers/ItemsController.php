<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function showItems(Request $request)
    {
        $items = Item::orderByRaw("FIELD(state,'".Item::STATE_SELLING."','".Item::STATE_BOUGHT."')")
            ->orderBy('id','DESC')
            ->paginate('1');
        return view('items.items')
            ->with('items', $items);
    }
    public function showItemDetail(Item $item)
    {
        return view('items.item_detail')
            ->with('item', $item);
    }
}
