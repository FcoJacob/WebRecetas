@extends('layouts.app')

@section('content')
<div class="container">     
    <div id="crud" class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">Recetas</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif    

                    Bienvenido a Recipes of Kitchen, disfrute de la comida!
                    
                    <receta style="margin: 20px auto;"></receta>
                </div>
            </div>
        </div>
        <br> 
        <hr> 
        <br>      
        <div class="col-sm-12">
            <h1>Lista de recetas</h1>
            <hr>
        </div>   
        <div class="col-sm-12">
            <a href="#" class="btn btn-primary float-right" data-toggle="modal" data-target="#create">Nueva Receta</a>        
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>Autor</th>
                        <th>Valoración</th>
                        <th>Breve Descripción</th>
                        <th colspan="2">
                            &nbsp;
                        </th>
                    </tr>
                </thead> 
                <tbody>
                    <tr v-for="recipe in keeps" :key="recipe.idReceta" v-on:click="showKeep(recipe.idReceta)">
                        <td width="10px">@{{ recipe.autor }}</td>
                        <td align="center" v-if="recipe.valoracion > 0">
                        <ul id="valoracion">
                            <li v-for="star in recipe.valoracion" v-if="star > 0"><i class="material-icons" style="color: orange;">star</i></li>
                        </ul>  
                        </td>
                        <td align="center" v-else>Sin Valorar</td>
                        <td>@{{ recipe.breveDescripcion }}</td>
                        <td width="10px">
                            <a href="#" class="btn btn-warning btn-sm" v-on:click.prevent="editKeep(recipe)">Editar</a>
                        </td>
                        <td width="10px">
                            <a href="#" class="btn btn-danger btn-sm" v-on:click.prevent="deleteKeep(recipe)">Eliminar</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <nav>
                <ul class="pagination justify-content-center pagination-sm">
                    <li class="page-item" v-if="pagination.current_page > 1">
                        <a href="#" class="page-link" @click.prevent="changePage(1)">
                            <span> Inicio </span>
                        </a>
                    </li>

                    <li class="page-item" v-for="page in pagesNumber" :key="page" v-bind:class="[page == isActived ? 'active' : '']">
                        <a href="#" class="page-link" @click.prevent="changePage(page)">
                            @{{ page }}
                        </a>
                    </li>
                    
                    <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                        <a href="#" class="page-link" @click.prevent="changePage(pagination.last_page)">
                            <span> Final </span>
                        </a>
                    </li>
                </ul>
            </nav>
            @include('create')
            @include('edit')                      
        </div>              
    </div>   
</div>
@endsection
