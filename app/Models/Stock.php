<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'stocks';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'item_id',
        'shop_id',
        'stock_quantity',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

}
