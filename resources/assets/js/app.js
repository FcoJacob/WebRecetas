/*jshint esversion: 6 */

require('es6-shim');

import Vue from 'vue';
import axios from 'axios';

var receta = {receta: null};

Vue.component('receta', {
    template: ` <div class='container'>
                    <div class='row'>
                        <div class='col-6'>
                            <img v-bind:src="'data:image/jpeg;base64,'+receta.imagen" height='400px' style='width: 100%;object-fit: fill;'>
                        </div>
                        <div class='col-6'>
                            <div class='row'>
                                <div class='col'>
                                    <h6><strong>Autor: </strong> {{ receta.autor }}</h6>
                                </div>
                                <div class='col'>
                                    <p>Última actualización: </p>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col'>
                                    <ul id="valoracion">
                                        <li v-for="star in receta.valoracion" v-if="star > 0" style='list-style:none;'><i class="material-icons" style="color: orange;font-size:large;">star</i></li>
                                    </ul>                                     
                                </div>
                                <div class='col'>
                                    <p>2018-02-22</p>
                                </div>                            
                            </div>
                            <div class='row'>
                                <h5>Ingredientes: </h5>
                            </div>
                            <div class='row'>                                
                                <ul style='list-style:none;'>
                                    <li v-for="value in receta.ingredientes.split(',')" :key='value'>{{ value }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <h5 style='margin-top: 20px; margin-left: 20px;text-decoration:underline;'>Elaboración: </h5>
                    </div>
                    <div class='row'>
                        <p style='text-indent: 40px;text-align: justify;font-family: Roboto;margin-left: 20px;'>{{ receta.elaboracion }}</p>
                    </div>
                </div>`,
    
    data: function () {
        console.log('data');
        return receta;
    }
});

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
        fillKeep: {'idReceta': '', 'autor': '', 'valoracion': '', 'breveDescripcion': '', 'cantidad': '', 'ingredientes': '', 'elaboracion': '', 'consejo': '', 'imagen': ''},
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
                console.log(response.data.recipes);
                this.keeps = response.data.recipes;
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
            axios.delete(url).then(response => {            //eliminamos
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
                this.errors = [],
                $('#create').modal('hide');
                toastr.success('Nueva tarea creada con exito');
            }).catch(error => {
                this.errors = error.response.data;
            });
        },
        showKeep: function(idReceta) {  
            receta.receta = this.keeps.find(function(element) {
                return element.idReceta == idReceta;
            });
            console.log(receta);
        },
        changePage: function(page) {
            this.pagination.current_page = page;
            this.getKeeps(page);
        }
    }    
});