<?php

namespace Modules\LAM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Address extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::saved(function ($model){
            if($model->is_default){
                $model->owner->addresses()->where("id","!=",$model->id)->update(["is_default"=>false]);
            }
        });
    }
    protected $fillable = [
        "address",
        "name",
        "city",
        "country",
        "is_default",
        "location",
        "properties",
    ];


    protected $casts = [
        "properties"=>"array"
    ];

    public function owner(): MorphTo{
        return $this->morphTo();
    }

    protected static function newFactory()
    {
        return \Modules\Utility\Database\factories\AddressFactory::new();
    }

}
