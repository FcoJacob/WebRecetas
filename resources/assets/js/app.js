/*jshint esversion: 6 */

require('es6-shim');

import Vue from 'vue';
import axios from 'axios';

const Recetas = {
    receta: [],    
    template: `<div>
                    <ul class="cardslider__cards">
                        <li class="cardslider__card cardslider__card--transitions false cardslider__card--index-7">🍕</li>
                        <li>🍔</li>
                    </ul> 
                </div>`
};

new Vue({
    el: '#crud',
    created: function(){
        this.getKeeps();
    },      
    data: {
        keeps: [],
        pagination: {
            'total': 0,
            'current_page': 0,
            'per_page': 0,
            'last_page': 0,
            'from': 0,
            'to': 0
        },
        autor: '',
        valoracion: 0,
        breveDescripcion: '',
        cantidad: 0,
        ingrediente: '',
        elaboracion: '',
        consejo: '',
        imagen: '',
        errors: [],
        fillKeep: {'id': '', 'autor': '', 'valoracion': '', 'breveDesc': '', 'cantidad': '', 'ingrediente': '', 'elaboracion': '', 'consejo': '', 'imagen': ''},
        offset: 1
    },
    computed: {
        isActived: function() {
            return this.pagination.current_page;
        },
        pagesNumber: function() {
            if(!this.pagination.to){
                return [];
            }

            var from = this.pagination.current_page - this.offset;
            if(from < 1){
                from = 1;
            }

            var to = from + (this.offset * 2);
            if(to >= this.pagination.last_page){
                to = this.pagination.last_page;
            }

            var pagesArray = [];
            while(from <= to){
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        }
    },
    methods: {
        getKeeps: function(page) {
            var urlKeeps = 'recipes?page='+page;
            axios.get(urlKeeps).then(response => {
                this.keeps = response.data.recipes.data;
                this.pagination = response.data.pagination;
            });
        },
        editKeep: function(keep) {
            this.fillKeep.id = keep.id;
            this.fillKeep.keep = keep.keep;
            $('#edit').modal('show');

        },
        updateKeep: function(id) {
            var url = 'recipes/'+id;
            axios.put(url, this.fillKeep).then(response => {
                this.getKeeps();
                this.fillKeep = {'id': '', 'keep': ''};
                this.errors =  [];
                $('#edit').modal('hide');
                toastr.success('Tarea actualizada con éxito.');
            }).catch(error = function() {
                this.errors = error.response.data;
            });
        },
        deleteKeep: function(keep){
            var url = 'recipes/'+keep.id;
            axios.delete(url).then(response => {  //eliminamos
                this.getKeeps();                            //listamos
                toastr.success('Eliminado correctamente');  //mensaje
            });
        },
        createKeep: function() {
            var url = 'recipes';
            axios.post(url, {
                keep: this.autor
            }).then(response => {
                this.getKeeps();
                this.autor = '',
                this.valoracion = 0,
                this.breveDescripcion = '',
                this.cantidad = 0,
                this.ingrediente = '',
                this.elaboracion = '',
                this.consejo = '',
                this.imagen = '',
                this.errors = [];
                $('#create').modal('hide');
                toastr.success('Nueva tarea creada con exito');
            }).catch(error => {
                this.errors = error.response.data;
            });
        },
        showKeep: function(idReceta) {            
            Recetas.receta = this.keeps
            console.log(Recetas.receta)
        },
        changePage: function(page) {
            this.pagination.current_page = page;
            this.getKeeps(page);
        }
    },
    components: {        
        'receta': Recetas,        
    }
});