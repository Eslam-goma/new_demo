<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function index()
    {
        return Agent::all();
    }

    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:agents,email',
            'phone' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'package' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'convention_team_leader_id' => 'required|string|min:255',
        ]);

        // Create a new Agent
        $agent = Agent::create($request->all());

        return response()->json($agent, 201);
    }

    public function show($id)
    {
        // Find Agent by ID
        $agent = Agent::findOrFail($id);
        return response()->json($agent);
    }

    public function update(Request $request, $id)
    {
        // Validate incoming request
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:agents,email,' . $id,
            'phone' => 'sometimes|required|string|max:20',
            'country' => 'sometimes|required|string|max:255',
            'package' => 'sometimes|required|string|max:255',
            'password' => 'sometimes|required|string|min:8'
        ]);

        // Find Agent by ID and update
        $agent = Agent::findOrFail($id);
        $agent->update($request->all());

        return response()->json($agent);
    }

    public function destroy($id)
    {
        // Delete Agent by ID
        Agent::destroy($id);
        return response()->json(null, 204);
    }
}
