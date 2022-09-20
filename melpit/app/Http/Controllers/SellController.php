<?php

namespace App\Http\Controllers;
use App\Models\ItemCondition;
use App\Models\PrimaryCategory;
use Illuminate\Http\Request;

class SellController extends Controller
{
    public function showSellForm()
    {
        $categories = PrimaryCategory::query()
            ->with([
                'secondaryCategories' => function($query){
                    $query->orderBy('sort_no');
                }
            ])
            ->orderBy('sort_no')
            ->get();
            
        $conditions = ItemCondition::orderBy('sort_no')->get();
        return view('sell')
            ->with('categories', $categories)
            ->with('conditions', $conditions);
    }
}
