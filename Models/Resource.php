<?php

namespace Modules\LAM\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "model",
        "fields",
        "columns",
        "policies",
        "actions",
        "active",
    ];

    protected static function newFactory()
    {
        return \Modules\LAM\Database\factories\ResourceFactory::new();
    }
}
