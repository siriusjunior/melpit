<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class SellController extends Controller
{
    public function showSellForm()
    {
        return view('sell');
    }
}
