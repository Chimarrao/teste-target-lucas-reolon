<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Address;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index']]);
    }

    public function index()
    {
        return User::where('deleted', false)->get();
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());

        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->deleted = true;
        $user->save();

        return response()->json(null, 204);
    }

    public function assignAddress(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $address = $user->addresses()->create($request->all());

        return response()->json($address, 201);
    }

    public function updateAddress(Request $request, $userId, $addressId)
    {
        $user = User::findOrFail($userId);
        $address = $user->addresses()->findOrFail($addressId);

        $address->update($request->all());

        return response()->json($address, 200);
    }

    public function deleteAddress($userId, $addressId)
    {
        $user = User::findOrFail($userId);
        $address = $user->addresses()->findOrFail($addressId);

        $address->delete();

        return response()->json(null, 204);
    }
}