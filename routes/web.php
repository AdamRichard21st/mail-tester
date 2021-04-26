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
        'usage' => [
            [
                'route' => '/preview/{view-file-name}',
                'description' => 'Send a GET request to /preview/{view-file-name} to render its content.',
                'examples' => [
                    env('APP_URL').'/preview/prg-afiliados-cruzeiro',
                    env('APP_URL').'/preview/peça-de-teste',
                    env('APP_URL').'/preview/peça-abril-23-2021',
                ],
            ],
            [
                'route' => '/send/{view-file-name}',
                'description' => 'Send a GET request to /send/{view-file-name} in order to send an email with its content.',
                'examples' => [
                    env('APP_URL').'/send/prg-afiliados-cruzeiro',
                    env('APP_URL').'/send/peça-de-teste',
                    env('APP_URL').'/send/peça-abril-23-2021',
                ],
            ]
            
        ],
        'observations' => 'A valid view file must to be present inside /resource/views/ project folder.',
    ];
});


$router->get('/preview/{view}', function ($view) use ($router)
{
    if ( !$view )
    {
        return [
            'status' => 'failed',
            'message' => 'Please, send a view file name as path parameter. Example: '. env('APP_URL').'/preview/view-name',
        ];
    }

    if ( !view()->exists($view) )
    {
        return [
            'status' => 'failed',
            'message' => "View /resources/views/$view.[php|html] does not exist.",
        ];
    }

    return view($view);
});


$router->get('/send/{view}', function ($view) use ($router)
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
            'message' => "View /resources/views/$view.[php|html] does not exist.",
        ];
    }

    Mail::send($view, [], function($message)
    {
        $message->to('test@example.com', 'Test Mail')->subject(env('APP_URL'));
    });

    return view($view);
});