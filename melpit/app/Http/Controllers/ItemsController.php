<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function showItems(Request $request)
    {
        $query = Item::query();
        
        // カテゴリーによる絞込み検索
        if ($request->filled('category')) {
            list($categoryType, $categoryID) = explode(':', $request->input('category'));
            if ($categoryType === 'primary') {
                $query->whereHas('secondaryCategory', function ($query) use ($categoryID) {
                $query->where('primary_category_id', $categoryID);
            });
            } else if ($categoryType === 'secondary') {
            $query->where('secondary_category_id', $categoryID);
            }
        }
        $items = $query->orderByRaw("FIELD(state,'".Item::STATE_SELLING."','".Item::STATE_BOUGHT."')")
            ->orderBy('id', 'DESC')
            ->paginate(3);
        return view('items.items')
            ->with('items', $items);
    }

    public function showItemDetail(Item $item)
    {
        return view('items.item_detail')
            ->with('item', $item);
    }
}
