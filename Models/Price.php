<?php

namespace Modules\LAM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Utility\Traits\HasTag;

class Price extends Model
{
    use HasFactory, HasTag;

    protected static function booted()
    {
        static::saved(function ($model){
            if($model->is_default){
                $model->item->prices()->where('id','!=',$model->id)->update(['is_default'=>false]);
            }
        });
    }

    protected $fillable = [
        'price',
        'active',
        'is_default',
    ];
    protected static function newFactory()
    {
        return \Modules\Utility\Database\factories\PriceFactory::new();
    }
}
