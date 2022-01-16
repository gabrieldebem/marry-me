<?php

namespace App\Services;

use App\Models\Gift;

class GiftService
{
    private Gift $gift;

    public function setGift(Gift $gift): self
    {
        $this->gift = $gift;
        return $this;
    }

    public function getGift(): Gift
    {
        return $this->gift;
    }

}
