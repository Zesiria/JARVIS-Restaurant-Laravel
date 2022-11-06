<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Todo : validate
        return User::all('id','name','email','role');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response('',502);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Todo : validate

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $password = fake()->lexify("????????");
        $user->password = Hash::make($password);
        $user->role = $request->role;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => "User successfully created with id : {$user->id}",
            'name' => $user->name,
            'email' => $user->email,
            'password' => $password,
            'role' => $user->role
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Todo : validate

        $user = User::find($id);
        if($user == null)
            return response()->json([
                'message' => "This user id is not exists."
            ],400);

        if($request->exists('name'))
            $user->name = $request->name;
        if($request->exists('role'))
            $user->role = $request->role;
        if($request->exists('password'))
            $user->password = Hash::make($request->password);
        if($request->exists('email'))
            $user->email = $request->email;
        $user->save();

        return response()->json([
            'message' => "User successfully saved.",
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if($user == null)
            return response()->json([
                'message' => "This user id is not exists."
            ],400);
        if($user->role == 'Manager')
            return response()->json([
                'message' => 'Delete manager is not allowed.'
            ], 400);
        $user->delete();
        return \response()->json([
            'success' => true,
            'message' => 'Successfully deleted.'
        ],202);
    }

    public function changePassword(Request $request){
        if(!$request->exists('email')){
            return response()->json([
                'message' => "No email provided."
            ], 422);
        }
        if(!$request->exists('old_password')){
            return response()->json([
                'message' => "No old password provided."
            ], 422);
        }
        if(!$request->exists('new_password')){
            return response()->json([
                'message' => "No new password provided."
            ], 422);
        }

        $user = User::all()->where('email', $request->email)->first();
        if($user == null){
            return response()->json([
                'success' => false,
                'message' => "ไม่พบผู้ใช้งาน email นี้"
            ], 422);
        }

        if(Hash::check($request->old_password, $user->password)){
            $user->password = Hash::make($request->new_password);
            $user->save();
            return response()->json([
                'success' => true,
                'message' => "Successfully changed password."
            ], 200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => "รหัสผ่านเก่าไม่ถูกต้อง."
            ], 422);
        }


    }
}
