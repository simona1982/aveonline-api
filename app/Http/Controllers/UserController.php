<?php

namespace App\Http\Controllers;

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
        $data = User::orderBy('nombre', 'asc')->get();
        return response(['data' => $data], 200); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nombre'           => 'required',
            'login'            => 'required|unique:usuarios',
            'rol'              => 'required',
            'clave'            => 'required',
        ]);

        $user = new User();
        $user->login = $request->login;
        $user->clave = Hash::make($request->clave);
        $user->nombre = $request->nombre;
        $user->rol = $request->rol;
        $user->save();

        return response(['data' => $user], 200);

        //return response()->json(["msg" => "usuario registrado correctamente", data => $user], 201);

      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

        $user = User::find($id);
    
        $user->login =  empty($request->login) ? $user->login: $request->login;
        $user->clave = empty($request->login) ? $user->clave: Hash::make($request->clave);
        $user->nombre = empty($request->nombre) ? $user->nombre: $request->nombre;
        $user->rol = empty($request->rol) ? $user->rol: $request->rol;
        $user->save();

        return response(['data' => $user], 200);
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
        $userDestroy = $user->delete();

        return response(['data' => $userDestroy], 200);
    }
}
