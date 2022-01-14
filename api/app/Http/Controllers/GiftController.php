<?php

namespace App\Http\Controllers;

use App\Models\Gift;
use App\Services\GiftService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class GiftController extends Controller
{
    public function __construct(private GiftService $giftService)
    {
    }

    public function list(): Collection
    {
        return Gift::all();
    }

    public function show(Gift $gift): Gift
    {
        return $gift;
    }

    public function create(Request $request): JsonResponse
    {
        $gift = new Gift();
        $gift->product = $request->input('product');
        $gift->price = $request->input('price');
        $gift->picture = $this->giftService
            ->storeGiftPicture($request->input('picture'), $request->input('product'));
        $gift->store = $request->input('store');
        $gift->store_link = $request->input('store_link');

        $gift->save();

        return response()->json($gift);
    }

    public function update(Gift $gift, Request $request): Gift
    {
        $gift->update($request->all());

        return $gift;
    }

    public function delete(Gift $gift)
    {
        $gift->delete();
        //@todo remove this
        return response()->json(['message' => 'ok']);
    }
}
