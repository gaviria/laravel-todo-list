<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Item::orderBy('created_at', 'desc')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $newItem = new Item();
        $newItem->name = $request->item['task'];
        //$newItem->completed = $request->item['completed'];
        $newItem->save();

        //$newItem = Item::create($request->post());
        //return $newItem

        return $newItem;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //$itemUpdate = Item::findOrFail($id);
        $existingItem = Item::find($id);
        if ($existingItem) {
            $existingItem->completed = $request->item['completed'];
            $existingItem->updated_at = Carbon::now();
            $existingItem->save();
            return $existingItem;
        }

        return "Item not found";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //$itemUpdate = Item::findOrFail($id);
        $existingItem = Item::find($id);
        if ($existingItem) {
            $existingItem->delete();

            return "Item removed";
        }

        return "Item not found";
    }
}
