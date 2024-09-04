<?php

namespace App\Http\Controllers;

use App\Models\broker;
use Illuminate\Http\Request;

use App\Http\Requests\StorebrokerRequest;
use App\Http\Requests\UpdatebrokerRequest;

class BrokerController extends Controller
{
    public function index(Request $request)
    {
        // Get query parameters from the request
        $name = $request->query('name');
        $email = $request->query('email');
        $phone = $request->query('phone');
        $package = $request->query('package');
        $country = $request->query('country');

        // Build the query
        $query = Broker::query();

        if ($name) {
            $query->where('name', 'like', "%{$name}%");
        }
        if ($email) {
            $query->where('email', 'like', "%{$email}%");
        }
        if ($phone) {
            $query->where('phone', 'like', "%{$phone}%");
        }
        if ($package) {
            $query->where('package', 'like', "%{$package}%");
        }
        if ($country) {
            $query->where('country', 'like', "%{$country}%");
        }
        $brokers = $query->get();

        return response()->json($brokers);
    }



        public function show($id)
        {
            $broker = Broker::find($id);

            if ($broker) {
                return response()->json($broker);
            } else {
                return response()->json(['message' => 'Broker not found'], 404);
            }
        }

        // Create a new broker
        public function store(Request $request)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'country' => 'required|string|max:255',
                'package' => 'required|string|max:255',
                'password' => 'required|string|min:8', // Add validation for password

            ]);

            $broker = Broker::create($request->all());

            return response()->json($broker, 201);
        }

        // Update an existing broker
        public function update(Request $request, $id)
        {
            $broker = Broker::find($id);

            if ($broker) {
                $request->validate([
                    'name' => 'sometimes|required|string|max:255',
                    'email' => 'sometimes|required|email|max:255',
                    'phone' => 'sometimes|required|string|max:20',
                    'country' => 'sometimes|required|string|max:255',
                    'package' => 'sometimes|required|string|max:255',
                    'password' => 'sometimes|required|string|min:8', // Add validation for password

                ]);

                $broker->update($request->all());

                return response()->json($broker);
            } else {
                return response()->json(['message' => 'Broker not found'], 404);
            }
        }

        // Delete a broker
        public function destroy($id)
        {
            $broker = Broker::find($id);

            if ($broker) {
                $broker->delete();
                return response()->json(['message' => 'Broker deleted']);
            } else {
                return response()->json(['message' => 'Broker not found'], 404);
            }
        }
}
