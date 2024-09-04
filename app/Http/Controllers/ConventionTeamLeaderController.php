<?php
namespace App\Http\Controllers;

use App\Models\convention_team_leader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ConventionTeamLeaderController extends Controller
{
    public function index()
    {
        $leaders = convention_team_leader::with('broker')->get();
        return response()->json($leaders);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:convention_team_leaders',
            'phone' => 'required|string|max:15',
            'activity' => 'required|string|max:255',
            'permanent_address' => 'required|string|max:255',
            'broker_id' => 'required|exists:brokers,id',
            'password' => 'required|string|min:8',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        $leader = convention_team_leader::create($data);
        return response()->json($leader, 201);
    }

    public function show($id)
    {
        $leader = convention_team_leader::with(['broker', 'agents'])->findOrFail($id);
        return response()->json($leader);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:convention_team_leaders,email,' . $id,
            'phone' => 'sometimes|required|string|max:15',
            'activity' => 'sometimes|required|string|max:255',
            'permanent_address' => 'sometimes|required|string|max:255',
            'broker_id' => 'sometimes|required|exists:brokers,id',
            'password' => 'sometimes|required|string|min:8',
        ]);

        $leader = convention_team_leader::findOrFail($id);
        $data = $request->all();

        if ($request->has('password')) {
            $data['password'] = Hash::make($data['password']);
        }

        $leader->update($data);
        return response()->json($leader);
    }

    public function destroy($id)
    {
        $leader = convention_team_leader::findOrFail($id);
        $leader->delete();
        return response()->json(null, 204);
    }
}
