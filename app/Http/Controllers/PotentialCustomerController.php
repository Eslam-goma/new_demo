<?php
namespace App\Http\Controllers;

use App\Models\PotentialCustomer;
use Illuminate\Http\Request;

class PotentialCustomerController extends Controller
{
    // Display a listing of the potential customers
    public function index()
    {
        $customers = PotentialCustomer::all();
        return response()->json($customers);
    }

    // Store a newly created potential customer in storage
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:potential_customers',
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'broker_id' => 'required|exists:brokers,id',
            'status' => 'required|in:no_answer,call_back,new,interested,no_interested,busy,wrong_number',
            'agent_id' => 'required|exists:agents,id',
        ]);

        $customer = PotentialCustomer::create($request->all());

        return response()->json($customer, 201);
    }

    // Display the specified potential customer
    public function show($id)
    {
        $customer = PotentialCustomer::findOrFail($id);
        return response()->json($customer);
    }

    // Update the specified potential customer in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'sometimes|required|email|unique:potential_customers,email,' . $id,
            'name' => 'sometimes|required|string|max:255',
            'country' => 'sometimes|required|string|max:255',
            'phone' => 'sometimes|required|string|max:20',
            'broker_id' => 'sometimes|required|exists:brokers,id',
            'status' => 'sometimes|required|in:no_answer,call_back,new,interested,no_interested,busy,wrong_number',
            'agent_id' => 'sometimes|required|exists:agents,id',
        ]);

        $customer = PotentialCustomer::findOrFail($id);
        $customer->update($request->all());
        return response()->json($customer);
    }

    // Remove the specified potential customer from storage
    public function destroy($id)
    {
        $customer = PotentialCustomer::findOrFail($id);
        $customer->delete();
        return response()->json(null, 204);
    }
}
