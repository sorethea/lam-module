<?php

namespace Modules\LAM\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_id',
        'visit_type',
        'item_id',
        'item_type',
    ];

    protected static function newFactory()
    {
        return \Modules\Utility\Database\factories\VisitFactory::new();
    }

    public function item(): MorphTo{
        return $this->morphTo('item');
    }

    public function visitor(): MorphTo{
        return $this->morphTo('visitor');
    }
}
