<?php

namespace Modules\LAM\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Modules\LAM\Models\Visit;

trait HasVisit
{
    public function visitors(): MorphMany
    {
        return $this->morphMany(Visit::class,"visit");
    }
}
