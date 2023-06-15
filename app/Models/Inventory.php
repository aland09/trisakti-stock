<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // relation
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class, 'inventory_id');
    }
}
