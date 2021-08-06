<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get(
    '/',
    [
        'uses' => 'MainController@home',
        'as'   => 'main-home'
    ]
);

// Route permettant de récupérer toutes les catégories
$router->get(
    '/categories',
    [
        'uses' => 'CategoryController@list',
        'as'   => 'category-list'
    ]
);

// Route permettant de récupérer une catégorie
$router->get(
    '/categories/{id}',
    [
        'uses' => 'CategoryController@item',
        'as'   => 'category-item'
    ]
);

// Route permettant de récupérer toutes les tâches
$router->get(
    '/tasks',
    [
        'uses' => 'TaskController@list',
        'as'   => 'task-list'
    ]
);

// Route permettant de créer une tâche
$router->post(
    '/tasks',
    [
        'uses' => 'TaskController@add',
        'as'   => 'task-add'
    ]
);

// Route modifiant obligatoirement tous les champs d'une tâche
$router->put(
    '/tasks/{id}',
    [
        'uses' => 'TaskController@update',
        'as'   => 'task-update-put'
    ]
);

// Route ne modifiant qu'un seul champs d'une tâche
$router->patch(
    '/tasks/{id}',
    [
        'uses' => 'TaskController@update',
        'as'   => 'task-update-patch'
    ]
);


$router->delete(
    '/tasks/{id}',
    [
        'uses' => 'TaskController@delete',
        'as'   => 'task-delete'
    ]
);
