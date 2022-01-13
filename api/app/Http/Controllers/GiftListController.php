<?php

namespace App\Http\Controllers;

use App\Models\GiftList;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class GiftListController extends Controller
{
    public function list(): Collection
    {
        return GiftList::all();
    }

    public function show(GiftList $giftList): GiftList
    {
        return $giftList;
    }

    public function create(Request $request): JsonResponse
    {
        $user = new GiftList();

        $user->save();

        return response()->json($user);
    }

    public function update(GiftList $giftList, Request $request): GiftList
    {
        $giftList->update($request->all());

        return $giftList;
    }

    public function delete(GiftList $giftList)
    {
        $giftList->delete();
        //@todo remove this
        return response()->json(['message' => 'ok']);
    }
}
