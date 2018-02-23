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
        $recipe = Recipes::orderBy('idReceta', 'DESC')->paginate(1);
        $recipes =  [];
        foreach ($recipe as $rec){
            $recipes[] = [
                'idReceta'          => $rec->idReceta,
                'autor'             => $rec->autor,
                'valoracion'        => $rec->valoracion,
                'breveDescripcion'  => $rec->breveDescripcion,
                'cantidad'          => $rec->cantidad,
                'ingredientes'      => $rec->ingredientes,
                'elaboracion'       => $rec->elaboracion,
                'consejo'           => $rec->consejo,
                'imagen'            => base64_encode($rec->imagen),
                'updated_at'        => $rec->updated_at
            ];
        }        
        return [
           // 'imagen' => "data:imagen/jpg;base64,".base64_encode($recipe->imagen),
            'pagination' => [
                'total'         => $recipe->total(),
                'current_page'  => $recipe->currentPage(),
                'per_page'      => $recipe->perPage(),
                'last_page'     => $recipe->lastPage(),
                'from'          => $recipe->firstItem(),
                'to'            => $recipe->lastItem(),
            ],            
            'recipes' => $recipes
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
        /*$this->validate($request, [
            'idReceta' => 'required'
        ]);    */      
        $file = base64_encode(file_get_contents($request->file('imagen')));

        $receta = new Recipes();
        $receta->autor = $request->input('autor');
        $receta->valoracion = $request->input('valoracion');
        $receta->breveDescripcion = $request->input('breveDescripcion');
        $receta->cantidad = $request->input('cantidad');
        $receta->ingredientes = $request->input('ingredientes');
        $receta->elaboracion = $request->input('elaboracion');
        $receta->consejo = $request->input('consejo');
        $receta->imagen = $file;        
        $receta->save();       

        return;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idReceta
     * @return \Illuminate\Http\Response
     */
    public function show($idReceta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $idReceta
     * @return \Illuminate\Http\Response
     */
    public function edit($idReceta)
    {
        //Formulario con datis
        $recipe = Recipes::findOrFail($idReceta);

        return $recipe;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $idReceta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'idReceta' => 'required',
        ]);

        Recipes::find($request->idReceta)->update($request->all());

        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idReceta
     * @return \Illuminate\Http\Response
     */
    public function destroy($idReceta)
    {
        $recipe = Recipes::findOrFail($idReceta);        
        $recipe->delete();
    }
}
