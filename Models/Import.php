<?php

namespace Modules\LAM\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Import extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\LAM\Database\factories\ImportFactory::new();
    }

    public function target(): MorphTo{
        return $this->morphTo('importable');
    }
}
