<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Carro;
use DB;

class CarrosController extends Controller
{
    public function index()
    {
        $carro = Carro::all()->toArray();

        return response()->json($carro);
    }

    public function store(Request $request)
    {
        try{
            $carro = new Carro([
                'serie' => $request->input('serie'),
                'marca' => $request->input('marca'),
                'id_propietario' => $request->input('id_propietario'),
            ]);
            $carro->save();
            return response()->json(['status' => true, 'Great thanks'],200);
        }catch(\Exception $e){
            Log::critical("Could not store car: {$e->getCode()}, {$e->getLine()}, {$e->getMessage()}");
            return response('Something bad'.$e->getMessage(),500);
        }
    }

    public function show($id)
    {
        try{
            $carro = Carro::find($id);
            if(!$carro){
                return response()->json(['this id doesnt exist'], 404);
            }

            return response()->json($carro, 200);
        }catch(\Exception $e){
            Log::critical("Could not store car: {$e->getCode()}, {$e->getLine()}, {$e->getMessage()}");
            return response('Something bad',500);
        }
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
        try{
            $carro = Carro::find($id);
            if(!$carro){
                return response()->json(['this id doesnt exist'], 404);
            }

            $carro->delete();
            return response()->json('Car deleted', 200);

        }catch(\Exception $e){
            Log::critical("Could not store Car: {$e->getCode()}, {$e->getLine()}, {$e->getMessage()}");
            return response('Something bad',500);
        }
    }

    // public function general($id)
    // {
    //     try{
    //         $carro = DB::table('carros')->join('users', 'users.id', '=', 'carros.id_propietario')
    //         ->select('carros.marca as Marca', 'carros.serie as Serie', 'users.name as nombrePropietario')->where('carros.id_propietario',$id)->get();
    //         if(!$carro){
    //             return response()->json(['this id doesnt exist'], 404);
    //         }

    //         return response()->json($carro, 200);
    //     }catch(\Exception $e){
    //         Log::critical("Could not store car: {$e->getCode()}, {$e->getLine()}, {$e->getMessage()}");
    //         return response('Something bad'.$e->getMessage(),500);
    //     }
    // }

    // public function propietario($id)
    // {
    //     try{
    //         $propietario = DB::table('users')->join('carros', 'carros.id_propietario', '=', 'users.id')
    //         ->select('users.name as nombrePropietario')->where('carros.id_carro',$id)->get();
    //         if(!$propietario){
    //             return response()->json(['this id doesnt exist'], 404);
    //         }

    //         return response()->json($propietario, 200);
    //     }catch(\Exception $e){
    //         Log::critical("Could not store car: {$e->getCode()}, {$e->getLine()}, {$e->getMessage()}");
    //         return response('Something bad'.$e->getMessage(),500);
    //     }
    // }

}
