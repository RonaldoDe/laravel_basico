<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all()->toArray();

        return response()->json($user);
    }

    public function store(Request $request)
    {
        try{
            $user = new User([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
            ]);
            $user->save();
            return response()->json(['status' => true, 'Great thanks'],200);
        }catch(\Exception $e){
            Log::critical("Could not store user: {$e->getCode()}, {$e->getLine()}, {$e->getMessage()}");
            return response('Something bad',500);
        }
    }

    public function show($id)
    {
        try{
            $user = User::find($id);
            if(!$user){
                return response()->json(['this id doesnt exist'], 404);
            }

            return response()->json($user, 200);
        }catch(\Exception $e){
            Log::critical("Could not store user: {$e->getCode()}, {$e->getLine()}, {$e->getMessage()}");
            return response('Something bad',500);
        }
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        try{
            $user = User::find($id);
            if(!$user){
                return response()->json(['this id doesnt exist'], 404);
            }

            $user->delete();
            return response()->json('User deleted', 200);

        }catch(\Exception $e){
            Log::critical("Could not store user: {$e->getCode()}, {$e->getLine()}, {$e->getMessage()}");
            return response('Something bad',500);
        }
    }

}
