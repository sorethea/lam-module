<?php

namespace Modules\LAM\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Modules\LAM\Models\Price;

trait HasPrice
{
    public function prices() : MorphMany{
        return $this->morMany(Price::class,"item");
    }

    public function getPriceAttribute() : float {
        $price = $this->prices()->where("is_default",true)->first();
        return $price->price??0;
    }
}
