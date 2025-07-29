<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('items.index', compact('items'));
    }

    public function create()
    {
        return view('items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required|in:Allowed,Prohibited',
            'description' => 'nullable',
        ]);

        Item::create($request->all());
        return redirect()->route('items.index');
    }

    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, Item $item)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required|in:Allowed,Prohibited',
            'description' => 'nullable',
        ]);

        $item->update($request->all());
        return redirect()->route('items.index');
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index');
    }

    public function generate()
    {
        $count = 1000;
        $statuses = ['Allowed', 'Prohibited'];

        for ($i = 0; $i < $count; $i++) {
            Item::create([
                'name' => 'Item ' . ($i + 1),
                'status' => $statuses[$i % 2],
                'description' => 'Description for item ' . ($i + 1),
            ]);
        }

        return redirect()->route('items.index');
    }

    public function clear()
    {
        Item::truncate();
        return redirect()->route('items.index');
    }

    public function fetch($count = null)
    {
        $exitCode = Artisan::call('google:fetch', [
            'count' => $count,
        ]);

        return '<pre>' . Artisan::output() . '</pre>';
    }
}
