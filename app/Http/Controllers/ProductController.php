<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Carbon;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /******RECEBER USER (GET)*****/
        return Product::orderBy('created_at', 'DESC')->get();
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
        /******CRIAR USER (POST)*****/
        $newProduct = new Product();

        $newProduct->name = $request->product["name"];
        $newProduct->type = $request->product["type"];
        $newProduct->description = $request->product["description"];
        $newProduct->photo_url = $request->product["photo_url"];  
        $newProduct->price = $request->product["price"];

        $newProduct->save();

        return $newProduct;
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
        /****MODIFICAR VALOR****/
        $existingProduct = Product::find( $id );

        //VERIFICAMOS SE O PRODUTO EXISTE E MODAMOS O VALOR DO PRECO
        //EXISTE
        if( $existingProduct ){
            $existingProduct->price = $request->product['price'];
            //carbon set the date and time
            $existingProduct->updated_at = $request->product['price'] ? Carbon::now() : null;
            $existingProduct->save();
            return $existingProduct;
        }
        //NAO EXISTE
        return "User not found";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existingProduct = Product::find( $id );
        if($existingProduct){
            $existingProduct->delete();
            return "Product successfully deleted";
        }
        return "Product not found";
    }
}
