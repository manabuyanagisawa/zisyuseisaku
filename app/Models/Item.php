<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Shop;

class Item extends Model
{

    public static function getBrandName($brand_id){
        $brands = config('brand.brands');
        return $brands[$brand_id];
    }
    public static function getTypeName($type_id){
        $types = config('type.types');
        return $types[$type_id];
    }
    public static function getStatusName($status_id){
        $statuses = config('status.statuses');
        return $statuses[$status_id];
    }
    public static function getSizeName($size_id){
        $sizes = config('size.sizes');
        return $sizes[$size_id];
    }
    public static function getColorName($color_id){
        $colors = config('color.colors');
        return $colors[$color_id];
    }

    
    protected $table = 'items';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'update_user_id',
        'price',
        'name',
        'type',
        'brand',
        'wear_size',
        'color',
        'season',
    ];

    public function shops()
    {
        return $this->belongsToMany(Shop::class, 'stock');
    }

    protected $with = ['stocks']; // Eager Loadingの指定

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];
}
