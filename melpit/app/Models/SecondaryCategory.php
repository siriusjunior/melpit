<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecondaryCategory extends Model
{
    public function PrimaryCategory()
    {
        return $this->belongsTo(PrimaryCategory::class);
    }
}
