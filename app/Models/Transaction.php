<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // protected $fillable = [
    //     'uuid',
    //     'date',
    //     'inventory_name',
    //     // 'user_id',
    //     'inventory_id',
    //     'quantity',
    //     'notes',
    //     // 'quantity',
    //   ];

    // relation
    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
