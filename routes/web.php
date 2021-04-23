<?php

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


use Illuminate\Support\Facades\Mail;


$router->get('/', function () use ($router)
{
    return [
        'message' => 'Send a GET request to /{view-file-name} in order to send an email with its content.',
        'observations' => 'A valid view file must to be present inside /resource/views/ project folder.',
        'examples' => [
            env('APP_URL').'/prg-afiliados-cruzeiro',
            env('APP_URL').'/peça-de-teste',
            env('APP_URL').'/peça-abril-23-2021',
        ],
    ];
});


$router->get('/{view}', function ($view) use ($router)
{
    if ( !$view )
    {
        return [
            'status' => 'failed',
            'message' => 'Please, send a view file name as path parameter. Example: '. env('APP_URL').'/view-name',
        ];
    }

    if ( !view()->exists($view) )
    {
        return [
            'status' => 'failed',
            'message' => "View $view does not exists.",
        ];
    }

    Mail::send($view, [], function($message)
    {
        $message->to('test@example.com', 'Test Mail')->subject(env('APP_URL'));
    });

    return view($view);
});
