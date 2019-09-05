<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//INICIO - Creando ruta personalizada

Route::get('mi-ruta-amigable', function (){
        return ' Esta es mi ruta. ';
    }
);

//FIN - Creando ruta personalizada

//INICIO -   Como definir rutas con parametros 

Route::get('saludo/{person}', function ($person){
        return 'Hola ' . $person;
        //En el Browser enviar de esta manera la ruta : http://127.0.0.1:8000/saludo/Anderson y enter.
    }
);

//FIN -   Como definir rutas con parametros 


//INICIO -   Como definir rutas con parametros / Saludo Opcional que se pueda pasar o no

Route::get('saludo/{person?}', function ($person = 'Saludos Nankings Colors'){
    return 'Hola ' . $person;
    //En el Browser enviar de esta manera la ruta
    }
);

//FIN -   Como definir rutas con parametros / Saludo Opcional que se pueda pasar o no

//INICIO -  Ruta Nombrada que trabaja con RUTAS NOMBRADAS

Route::get('nombrada/{person?}', function ($person = 'Ruta Nombrada'){
    return 'Hola ' . $person;
    //En el Browser enviar de esta manera la ruta
    }
)
//Nombrando la Ruta
->name('rutanombradanankings')
;

//FIN -   Ruta Nombrada que trabaja con RUTAS NOMBRADAS


//INICIO -  restriccion de parametros con expresiones regulares

Route::get('pares-hasta-{number}', function ($number){
        $resultado=[];

        for($i = 0; $i <= $number; $i++){
            if($i % 2 === 0){
                $resultado[] = $i;
            }
        }
        return json_encode($resultado);
    }
)
//Para restringuir que en la ruta envie solo numeros, ya que debemos decirle que solo los numeros deben enviarse y no caracteres utilizamos
//una funcion llamada '->where' //(Estas son expresiones regulares (buscar en google) : ['number' =>'[\d]+'] (Para restringuir texto))
->where(['number' =>'[\d]+'])
;

//FIN-  restriccion de parametros con expresiones regulares
 

//INICIO - Rutas Nombradas

    //INICIO RUTAS NOMBRADAS - Redireccion de paginas
    Route::get('hi', function (){
        //Puede ser de las dos formas
        //PRIMERA:
            //return redirect()->to('saludo');
        //SEGUNDA - con parametros
            //return redirect()->to('saludo/Anderson');
        //TERCERA - Nombrar rutas: esta ruta trabaja con la Ruta llamada nombrada (que esta arriba)
        //Utilizamos la funcion 'route' para utilizar la ruta nombrada
        return redirect()->route('rutanombradanankings'
            //INICIO - Pasando parametros,
            //tener cuidado con el nombre de las variables, tanto en la variable de la ruta, como la variable de la funcion,
            //luego de hacer esto revisar la ruta del navegador, nos muestra de la siguiente forma : http://127.0.0.1:8000/nombrada/Anderson
            , ['person'=> 'Anderson']
            //FIN - Pasando Parametros
            );
        }
    );
    //FIN RUTAS NOMBRADAS - Redireccion de paginas

//FIN - Rutas Nombradas

//INICIO - GRUPOS DE RUTAS

    //INICIO - CREANDO GURPOS DE RUTAS

    Route::group(['prefix'=> 'administracion'], function(){
        
        //Primera ruta anidada al grupo de rutas
        Route::get('clientes', function (){
            return 'Aqui se Administraran los artistas';
        });
        //Segunda ruta anidada al grupo de rutas
        Route::get('imagenes', function (){
            return 'Aqui se administraran las imagenes';
        });
    }
    );

    //FIN - CREANDO GURPOS DE RUTAS

//FIN - GRUPOS DE RUTAS