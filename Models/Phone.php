<?php

namespace Modules\LAM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Phone extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::saved(function ($model){
            if($model->is_default){
                $model->owner->phones()->where('id','!=',$model->id)->update(['is_default'=>false]);
            }
        });
    }

    protected $fillable = [
        "phone_number",
        "remark",
        "is_default",
    ];

    public function owner(): MorphTo{
        return $this->morphTo();
    }

    protected static function newFactory()
    {
        return \Modules\Utility\Database\factories\PhoneFactory::new();
    }

}
