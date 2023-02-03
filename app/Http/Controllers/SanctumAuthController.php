<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SanctumAuthController extends Controller
{
    public function register(Request $request) {
        $request->validate([
            'login' => 'required | unique:usuarios',
            'clave' => 'required | confirmed',
            'nombre' => 'required',
            'rol' => 'required'
        ]);

        $user = new User();
        $user->login = $request->login;
        $user->clave = Hash::make($request->clave);
        $user->nombre = $request->nombre;
        $user->save();

        return response()->json(["msg" => "usuario registrado correctamente"], 201);
        
    }

    public function login(Request $request) {
        $request->validate([
            'login' => 'required',
            'clave' => 'required'
        ]);
        
        $user = User::where("login", "=", $request->login)->first();

        if(isset($user)) {
            if(Hash::check($request->clave, $user->clave)) {
                $token = $user->createToken("auth_token")->plainTextToken;
                return response()->json(["msg" => "sesion iniciada", "access_token" => $token]);
            } else {
            return response()->json(["msg" => "clave incorrecta", "error" => true], 200);
        }   
        }else {
            return response()->json(["msg" => "usuario no existe", "error" => true], 200);
        }
        
    }

    public function profile() {
        return Auth::user();
    }
}
