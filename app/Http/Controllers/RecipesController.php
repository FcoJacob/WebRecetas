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
        $this->validate($request, [
            'idReceta' => 'required'
        ]);          
        
        $receta = new Recipes();
        $nota->autor = $request->input('autor');
        $nota->valoracion = $request->input('valoracion');
        $nota->breveDescripcion = $request->textarea('breveDescripcion');
        $nota->cantidad = $request->input('cantidad');
        $nota->ingredientes = $request->textarea('ingredientes');
        $nota->elaboracion = $request->textarea('elaboracion');
        $nota->consejo = $request->textarea('consejo');
        $nota->imagen = base64_encode(file_get_contents($request->file('imagen')));        
        $nota->save();       

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
