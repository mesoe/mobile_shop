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

Route::get('/',[
    'uses'=>'AuthController@getLogin',
    'as'=>'/'
]);

Route::get('/login',[
    'uses'=>'AuthController@getLogin',
    'as'=>'login'
]);

Route::post('/login',[
    'uses'=>'AuthController@postLogin',
    'as'=>'login'
]);

Route::group(['middleware'=>'role:Admin'],function (){
    Route::get('/register',[
        'uses'=>'AuthController@getRegister',
        'as'=>'register'
    ]);
    Route::post('/register',[
        'uses'=>'AuthController@postRegister',
        'as'=>'register'
    ]);
    Route::get('/employees',[
        'uses'=>'HomeController@getEmployees',
        'as'=>'employees'
    ]);
    Route::post('/updateUserRole',[
        'uses'=>'HomeController@postUpdateUserRole',
        'as'=>'updateUserRole'
    ]);
    Route::post('/removeUser',[
        'uses'=>'HomeController@removeUser',
        'as'=>'removeUser'
    ]);
    Route::post('/changePassword',[
        'uses'=>'HomeController@changePassword',
        'as'=>'changePassword'
    ]);
});

Route::group(['middleware'=>'auth'],function (){
    Route::get('/detail/{id}',[
        'uses'=>'OrderController@getDetail',
        'as'=>'detail'
    ]);
    Route::get('/print/{id}',[
        'uses'=>'OrderController@getPrint',
        'as'=>'print'
    ]);
    Route::get('/searchByDate',[
        'uses'=>'OrderController@getSearchByDate',
        'as'=>'searchByDate'
    ]);
    Route::get('/report',[
        'uses'=>'OrderController@report',
        'as'=>'report'
    ]);
    Route::post('/checkout',[
        'uses'=>'CartController@postCustomer',
        'as'=>'checkout'
    ]);
    Route::post('/payment',[
        'uses'=>'CartController@postPayment',
        'as'=>'payment'
    ]);
    Route::get('/increaseCart/{id}',[
        'uses'=>'CartController@increaseCart',
        'as'=>'increaseCart'
    ]);
    Route::get('/decreaseCart/{id}',[
        'uses'=>'CartController@decreaseCart',
        'as'=>'decreaseCart'
    ]);
    Route::get('/removeItem/{id}',[
        'uses'=>'CartController@getRemoveItem',
        'as'=>'removeItem'
    ]);
    Route::post('/addToCart',[
        'uses'=>'CartController@addToCart',
        'as'=>'addToCart'
    ]);
    Route::get('/sale',[
        'uses'=>'CartController@getSale',
        'as'=>'sale'
    ]);
    Route::get('/editProduct/{id}',[
        'uses'=>'ProductController@editProduct',
        'as'=>'editProduct'
    ]);
    Route::post('/postEditProduct',[
        'uses'=>'ProductController@postEditProduct',
        'as'=>'postEditProduct'
    ]);
    Route::get('/deleteProduct',[
        'uses'=>'ProductController@deleteProduct',
        'as'=>'deleteProduct'
    ]);
    Route::post('/getBarcode',[
        'uses'=>'ProductController@getBarcode',
        'as'=>'getBarcode'
    ]);
    Route::get('/showProduct',[
        'uses'=>'ProductController@showProduct',
        'as'=>'showProduct'
    ]);
    Route::post('/newProduct',[
        'uses'=>'ProductController@postNewProduct',
        'as'=>'newProduct'
    ]);
    Route::get('/getNewProduct',[
        'uses'=>'ProductController@getNewProduct',
        'as'=>'getNewProduct'
    ]);
    Route::get('/delCategory',[
        'uses'=>'ProductController@deleteCategory',
        'as'=>'delCategory'
    ]);
    Route::post('/newCategory',[
        'uses'=>'ProductController@newCategory',
        'as'=>'newCategory'
    ]);
    Route::get('/getCategory',[
        'uses'=>'ProductController@getCategory',
        'as'=>'getCategory'
    ]);
    Route::post('/imageUpload',[
        'uses'=>'HomeController@postUserImage',
        'as'=>'imageUpload'
    ]);
    Route::get('/userImage/{file_name}',[
        'uses'=>'HomeController@getUserImage',
        'as'=>'userImage'
    ]);
    Route::get('/profile',[
        'uses'=>'HomeController@getProfile',
        'as'=>'profile'
    ]);
    Route::get('/error',[
        'uses'=>'AuthController@getError',
        'as'=>'error'
    ]);
    Route::get('/dashboard',[
        'uses'=>'HomeController@getDashboard',
        'as'=>'dashboard'
    ]);
    Route::get('/logout',[
        'uses'=>'AuthController@getLogout',
        'as'=>'logout'
    ]);
});

