<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class Shop extends Model
{
    use HasFactory;

    protected $table = 'shops';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    public function items()
    {
        return $this->belongsToMany(Item::class, 'stock');
    }
}
