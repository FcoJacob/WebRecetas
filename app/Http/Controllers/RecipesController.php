<?php

namespace RecipesOfKitchen\Http\Controllers;

use Illuminate\Http\Request;
use RecipesOfKitchen\Recipes;

class RecipesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $recipe = Recipes::orderBy('idReceta', 'DESC')->paginate(8);

        return [
            'pagination' => [
                'total'         => $recipe->total(),
                'current_page'  => $recipe->currentPage(),
                'per_page'      => $recipe->perPage(),
                'last_page'     => $recipe->lastPage(),
                'from'          => $recipe->firstItem(),
                'to'            => $recipe->lastItem(),
            ],
            'recipes' => $recipe
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Formulario
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
            'id' => 'required'
        ]);          
        
        $receta = new Recipes();
        $nota->autor = $request->input('autor');
        $nota->valoracion = $request->input('valoracion');
        $nota->breveDescripcion = $request->textarea('breveDesc');
        $nota->cantidad = $request->input('cantidad');
        $nota->ingredientes = $request->textarea('ingrediente');
        $nota->elaboracion = $request->textarea('elaboracion');
        $nota->consejo = $request->textarea('consejo');
        $nota->save();

        $path = $request->file('imagen')->storeAs(
            'imagenes', $request->user()->id
        ); 

        return;
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
        //Formulario con datis
        $recipe = Recipes::findOrFail($id);

        return $recipe;
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
        $this->validate($request, [
            'id' => 'required',
        ]);

        Recipes::find($id)->update($request->all());

        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recipe = Recipes::findOrFail($id);
        $recipe->delete();
    }
}
