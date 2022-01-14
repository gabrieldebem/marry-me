<?php

namespace App\Services;

use App\Models\Gift;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

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

    public function storeGiftPicture($picture, string $productName): string
    {
        Storage::put("/product_pics/{$productName}.jpeg", $picture);

        return Storage::url("/product_pics/{$productName}.jpeg");
    }
}
