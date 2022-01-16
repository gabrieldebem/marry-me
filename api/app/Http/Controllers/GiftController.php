<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Models\Gift;
use App\Services\GiftService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GiftController extends Controller
{
    public function __construct()
    {
    }

    public function list(): Collection
    {
        return Gift::where('user_id', Auth::id())
            ->get();
    }

    public function show(Gift $gift): Gift
    {
        if ($gift->user_id !== Auth::id()){
            abort(404);
        }
        return $gift;
    }

    public function create(Request $request): JsonResponse
    {
        $gift = new Gift();
        $gift->user_id = Auth::id();
        $gift->product = $request->input('product');
        $gift->price = $request->input('price');
        $gift->picture = $request->file('picture')->store('/');
        $gift->store = $request->input('store');
        $gift->store_link = $request->input('store_link');
        $gift->access_key = Str::random(8);

        $gift->save();

        return response()->json($gift);
    }

    public function update(Gift $gift, Request $request): Gift
    {
        //@todo implement this on request
        if ($gift->user_id !== Auth::id()){
            abort(404);
        }

        $gift->update($request->all());

        return $gift;
    }

    public function delete(Gift $gift): JsonResponse
    {
        //@todo implement this on request
        if ($gift->user_id !== Auth::id()){
            abort(404);
        }

        $gift->delete();

        //@todo remove this
        return response()->json(['message' => 'ok']);
    }

    public function downloadPicture(Gift $gift)
    {
        return Storage::download($gift->picture);
    }
}
