<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    
    protected $table = 'items';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'update_user_id',
        'status',
        'price',
        'name',
        'type',
        'brand',
    ];

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
