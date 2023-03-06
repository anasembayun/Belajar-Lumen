<?php
/** @var \Laravel\Lumen\Routing\Router $router */

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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'penjualan'], function () use ($router) {
    $router->get('/', function () {
        return response()->json([[
            'id' => '1',
            'no' => 'sales0001',
            'customer' => 'Joko',
        ],
        [
            'id' => '2',
            'no' => 'sales0002',
            'customer' => 'Joko',
        ],
        [
            'id' => '3',
            'no' => 'sales0003',
            'customer' => 'Joko',
        ],
        [
            'id' => '4',
            'no' => 'sales0004',
            'customer' => 'Joko',
        ],
        [
            'id' => '5',
            'no' => 'sales0005',
            'customer' => 'Joko',
        ]
            ]);
    });

    $router->get('/{id}', function ($id) {
        return response()->json([
            'data' => [
                'id' => '1',
                'no' => 'sales0001',
                'customer' => 'Joko',
                'address' => 'Jakarta',
                'total' => '2000000',
            ]]);
    });

    $router->post('/', function () {
        return response()->json([
            'msg' => 'berhasil create data',
            'id' => '6']);
    });

    $router->put('/{id}', function (Request $request, $id) {
        $no = $request->input('no');
        return response()->json([
            'data' => [
                'id' => $id,
                'no' => $no,
                'customer' => 'Joko',
                'address' => 'Jakarta',
                'total' => '2000000',
            ]]);
    });

    $router->delete('/{id}', function ($id) {
        return response()->json([
            'msg' => "berhasil delete"]);
    });

    $router->get('/{id}/confirm', function (Request $request, $id) {
        $users = $request->user();
        Log::debug('>>>>>>>>>>>>>>>>>>>');
        Log::debug($users);
        if($users == null){
            return response()->json(['error' => 'Unauthorized'],
            401, ['X-Header-One' => 'Header Value']);
        }
        return response()->json([
            'msg' => "berhasil confirm"]);
    });

    $router->get('/{id}/send-email', function (Request $request, $id) {
        $user = $request->user();
        Mail::raw('This is the email body.', function ($message) {
            $message->to('anasembayun02@mail.ugm.ac.id')
                ->subject('Lumen email test');
            });    
        return response()->json([
            'msg' => "berhasil send email"]);
    });
});

$router->group(['prefix' => 'product'], function () use ($router) {
    $router->get('/','ProductController@index');
    $router->get('/{id}','ProductController@show');
    $router->post('/','ProductController@create');
    $router->put('/{id}','ProductController@update');
    $router->delete('/{id}','ProductController@destroy');
});
