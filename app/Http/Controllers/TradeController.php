<?php
namespace App\Http\Controllers;

use App\Models\Trade;
use Illuminate\Http\Request;

class TradeController extends Controller
{
    // Display a listing of trades (GET /trades)
    public function index()
    {
        $trades = Trade::all();
        return response()->json($trades);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'open_at' => 'nullable|date',
            'closed_at' => 'nullable|date',
            'asset' => 'required|string',
            'amount' => 'required|numeric',
            'qty' => 'required|integer',
            'pnl' => 'nullable|numeric',
            'opening_price' => 'required|numeric',
            'current_price' => 'nullable|numeric',
            'direction' => 'required|in:buy,sell',
            'status' => 'required|in:opening,closed,pending',
        ]);

        $trade = Trade::create($validatedData);
        return response()->json($trade, 201);
    }

    public function show($id)
    {
        $trade = Trade::findOrFail($id);
        return response()->json($trade);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'open_at' => 'nullable|date',
            'closed_at' => 'nullable|date',
            'asset' => 'required|string',
            'amount' => 'required|numeric',
            'qty' => 'required|integer',
            'pnl' => 'nullable|numeric',
            'opening_price' => 'required|numeric',
            'current_price' => 'nullable|numeric',
            'direction' => 'required|in:buy,sell',
            'status' => 'required|in:opening,closed,pending',
        ]);

        $trade = Trade::findOrFail($id);
        $trade->update($validatedData);

        return response()->json($trade);
    }


    public function destroy($id)
    {
        $trade = Trade::findOrFail($id);
        $trade->delete();

        return response()->json(null, 204);
    }
}
