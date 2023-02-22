<?php

namespace Modules\LAM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "slug",
        "model",
        "active",
    ];

    protected static function newFactory()
    {
        return \Modules\Utility\Database\factories\TagFactory::new();
    }
}
