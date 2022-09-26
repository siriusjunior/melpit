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
                $query->whereHas('secondaryCategory',function($query)use($categoryID){
                $query->where('primary_category_id', $categoryID);
            });
            } 
            else if ($categoryType === 'secondary') {
                $query->where('secondary_category_id', $categoryID);
            }
        }
        // キーワードによる絞込み検索,カテゴリとのAND検索(OR検索ではない)
        if  ($request->filled('keyword')){
            $keyword = '%'.$this->escape($request->input('keyword')).'%';
            $query->where(function($query) use ($keyword){
                $query->where('name','LIKE', $keyword);
                $query->orWhere('description','LIKE', $keyword);
            });
        }

        $items = $query->orderByRaw("FIELD(state,'".Item::STATE_SELLING."','".Item::STATE_BOUGHT."')")
            ->orderBy('id', 'DESC')
            ->paginate(3);
        
        return view('items.items')
            ->with('items', $items);
    }

    // 特殊記号を置換して無効化
    private function escape(string $value)
    {
        return str_replace(
            ['\\', '%', '_'],
            ['\\\\', '\\%', '\\_'],
            $value
        );
    }

    public function showItemDetail(Item $item)
    {
        return view('items.item_detail')
            ->with('item', $item);
    }
}
