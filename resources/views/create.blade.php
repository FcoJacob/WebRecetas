<form method="post" v-on:submit.prevent="createKeep">
    <div class="modal fade" id="create">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Crear Receta</h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>                
                </div> 
                <div class="modal-body">
                    <div class="form-row">
                        <div class="col">
                            <label for="autor">Autor</label>
                            <input type="text" name="autor" class="form-control" v-model="autor">
                        </div>
                        <div class="col" name="valoracionTitle"> 
                            <label for="valoracionTitle">Valoración</label>                            
                            <div class="form-check form-check-inline">                        
                                <input class="form-check-input" type="radio" name="valoracion" id="inlineRadio1" value="option1">
                                <label class="form-check-label" for="inlineRadio1">1</label>
                            </div>
                            <div class="form-check form-check-inline"> 
                                <input class="form-check-input" type="radio" name="valoracion" id="inlineRadio2" value="option2">
                                <label class="form-check-label" for="inlineRadio2">2</label>
                            </div>
                            <div class="form-check form-check-inline"> 
                                <input class="form-check-input" type="radio" name="valoracion" id="inlineRadio3" value="option3">
                                <label class="form-check-label" for="inlineRadio3">3</label>
                            </div>
                            <div class="form-check form-check-inline"> 
                                <input class="form-check-input" type="radio" name="valoracion" id="inlineRadio4" value="option4">
                                <label class="form-check-label" for="inlineRadio4">4</label>
                            </div>
                            <div class="form-check form-check-inline"> 
                                <input class="form-check-input" type="radio" name="valoracion" id="inlineRadio5" value="option5">
                                <label class="form-check-label" for="inlineRadio5">5</label>
                            </div>  
                        </div>                        
                    </div>                    
                    <br>                    
                    <div class="form-row">
                        <div class="col-8">
                        <div class="form-group">
                            <label for="breveDesc">Breve Descripción</label>
                            <textarea class="form-control" name="breveDescr" id="breveDesc" rows="1"></textarea>
                        </div>
                        </div>  
                        <div class="col-4">
                            <label for="cantidad">Cantidad</label>
                            <input type="number" class="form-control" name="cantidad">                            
                        </div>     
                    </div>        
                    <hr>                            
                    <div class="form-group">
                        <label for="ingrediente">Ingredientes <span style="font-size: 12px">(utilice (,) despues de cada linea)</span></label>
                        <textarea class="form-control" name="ingrediente" id="ingrediente" rows="3"></textarea>
                    </div> 
                    <div class="form-group">
                        <label for="elaboracion">Elaboración</label>
                        <textarea class="form-control" name="elaboracion" id="elaboracion" rows="4"></textarea>
                    </div> 
                    <div class="form-group">
                        <label for="consejo">Consejos</label>
                        <textarea class="form-control" name="consejo" id="consejo" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="imagen">Subir foto</label>
                        <input type="file" class="form-control-file" id="imagen" name="imagen">
                    </div>
                    <span v-for="error in errors" class="text-danger">@{{ error }}</span>
                </div>       
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Guardar" >
                </div>
            </div>           
        </div>
    </div>
</form>