<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    // 出品中
    const STATE_SELLING = 'selling';
    // 購入済
    const STATE_BOUGHT = 'bought';

    public function getIsStateSellingAttribute()
    {
        return $this->state == self::STATE_SELLING;
    }
    
    public function getIsStateBoughtAttribute()
    {
        return $this->state == self::STATE_BOUGHT;
    }

    public function secondaryCategory()
    {
        return $this->belongsTo(SecondaryCategory::class);
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
    
    public function condition()
    {
        return $this->belongsTo(ItemCondition::class, 'item_condition_id');
    }

    protected $casts = [
        'bought_at' => 'datetime',
    ];
}
