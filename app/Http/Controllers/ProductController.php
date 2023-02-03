<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::orderBy('nombre', 'asc')->get();
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
            'nombre'             => 'required',
            'descripcion'        => 'required',
            'precio_unidad'    => 'required',
            'numero_existencias' => 'required',
        ]);

        $product = new Product();
        $product->nombre = $request->nombre;
        $product->descripcion = $request->descripcion;
        $product->precio_unidad = (int)$request->precio_unidad;
        $product->numero_existencias = (int)$request->numero_existencias;
        $product->save();

        return response(['data' => $product], 200);
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
        $product = Product::find($id);
    
        $product->nombre =  empty($request->nombre) ? $product->nombre: $request->nombre;
        $product->descripcion = empty($request->descripcion) ? $product->descripcion: $request->descripcion;
        $product->precio_unidad = empty($request->precio_unidad) ? (int)$product->precio_unidad: (int)$request->precio_unidad;
        $product->numero_existencias = empty($request->numero_existencias) ? (int)$product->numero_existencias: (int)$request->numero_existencias;
        $product->save();

        return response(['data' => $product], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $productDestroy = $product->delete();

        return response(['data' => $productDestroy], 200);
    }
}
