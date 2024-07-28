<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function cart()
    {
        return $this->hasMany(cart::class);
    }

    public function order()
    {
        return $this->hasMany(order::class);
    }
    public function history()
    {
        return $this->hasMany(history::class);
    }
}
