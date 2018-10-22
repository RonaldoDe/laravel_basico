<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        try{
            if($request->isJson()){
                $user = User::all()->toArray();
                return response()->json($user, 201);
            }
            return response()->json(['Permiso no autorizado'], 401);
        }catch(\Exception $e){
            return response('Something bad',500);
        }
    }

    public function store(Request $request)
    {
        try{
            if($request->isJson()){
                $user = new User([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => bcrypt($request->input('password')),
                ]);
                $user->save();
                return response()->json(['status' => true, 'Great thanks'],201);
            }

            return response()->json(['Permiso no autorizado'],401);
        }catch(\Exception $e){
            Log::critical("Could not store user: {$e->getCode()}, {$e->getLine()}, {$e->getMessage()}");
            return response('Something bad',500);
        }
    }

    public function show($id, Request $request)
    {
        try{
            if($request->isJson()){
                $user = User::find($id);
                if(!$user){
                    return response()->json(['this id doesnt exist'], 404);
                }

            return response()->json($user, 200);
            }

            return response()->json(['Permiso no autorizado'],401);

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
