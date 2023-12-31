<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            "government"=>'required',
            "email"=>'required|email|unique:users',
            "password"=>'required',
            "street"=>'required',
            "mobile"=>'required',
            "role"=>'required',
        ]);
        $user = User::create($request->all());
        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function searchById($id)
    {
        $user = User::find($id);
        
        if (!$user) {
            return response()->json(['message' => 'user not found'], 404);
        }

        return  new UserResource($user);
    }
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'=>'required',
            "government"=>'required',
            "email"=>'required|email',
            "password"=>'required',
            "street"=>'required',
            "mobile"=>'required',
            "role"=>'required',
        ]);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'government' => $request->government,
            'street' => $request->street,
            'mobile' => $request->mobile,
        ];
        
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password); // Hash the password
        }
        
        $user->update($data);


        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->review()->delete();
        $user->transaction()->delete();
        $user->delete();

        return response()->json([
            "status" =>200,
            "msgg" =>"deleted successfully"
        ]);
    }
}
