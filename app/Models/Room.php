<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // relation
    public function inventory()
    {
        return $this->hasMany(Inventory::class, 'room_id');
    }
}
