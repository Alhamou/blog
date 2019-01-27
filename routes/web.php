<?php
use App\User;
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

// Route::get('/', function () {
//     return view('welcome');
// });



// Route::get('/about', function () {
//     return "hi About Page";
// });


// Route::get('/post/{id}', function ($id){

//     return "hallo ". $id;
// });

// Route::get('admin/post/example' , array( 'as' => 'admin.home', function(){

//     $url = route('admin.home');

//     return 'hallo '. $url;
// }));


# index Page
Route::get('/', 'PostController@index');

# About Page
Route::get('/about/{test}/{tow}', 'PostController@about');

# Source Postes
Route::resource('posts', 'PostController');



/*
|--------------------------------------------------------------------------
| Routes with Eloquent.
|--------------------------------------------------------------------------
*/

Route::get('/findall', function(){

    $user = User::all();

    return $user;

});


Route::get('/find', function(){

    # return Fail with 404 Page.
    $user = User::findOrFail(4);

    return $user;

});

Route::get('/findwhere', function(){

    $users = User::where('password', 'emad')->get();

    return $users;

});

Route::get('/findmore', function(){

    # return Fail with 404 Page.
    $userFail = User::where('password', 'emad')->firstOrFail();

    return $userFail;

});
