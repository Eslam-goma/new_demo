<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    // Display a listing of the leads
    public function index()
    {
        $leads = Lead::all();
        return response()->json($leads);
    }

    // Store a newly created lead in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:leads',
            'password' => 'required|string|min:8',
            'country' => 'required|string|max:255',
            'source' => 'required|string|max:255',
            'permanent_address' => 'required|string',
            'status' => 'required|in:lead,opportunity_customer,active_customer',
        ]);

        $lead = Lead::create($request->all());
        return response()->json($lead, 201);
    }

    // Display the specified lead
    public function show($id)
    {
        $lead = Lead::findOrFail($id);
        return response()->json($lead);
    }

    // Update the specified lead in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:leads,email,' . $id,
            'password' => 'sometimes|required|string|min:8',
            'country' => 'sometimes|required|string|max:255',
            'source' => 'sometimes|required|string|max:255',
            'permanent_address' => 'sometimes|required|string',
            'status' => 'sometimes|required|in:lead,opportunity_customer,active_customer',
        ]);

        $lead = Lead::findOrFail($id);
        $lead->update($request->all());
        return response()->json($lead);
    }

    // Remove the specified lead from storage
    public function destroy($id)
    {
        $lead = Lead::findOrFail($id);
        $lead->delete();
        return response()->json(null, 204);
    }
}
