<?php
use App\User;
use App\Post;
use App\Role;
use App\Country;
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

Route::get('/findpost', function(){

    $post = Post::all();

    return $post;

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


Route::get('/basicinsert', function(){

    $post = new Post;

    $post->title = "Hi im Emad";
    $post->body = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga, quis architecto mollitia possimus placeat, aut quaerat temporibus, voluptatibus nostrum omnis sit incidunt saepe rem quibusdam earum suscipit harum quidem! Velit!";
    
    $post->save();

    return 'Saved!';

});

Route::get('/basicupdate', function(){

    $post = Post::find(1);

    $post->title = "Hi im Emad Update";
    $post->body = "2Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga, quis architecto mollitia possimus placeat, aut quaerat temporibus, voluptatibus nostrum omnis sit incidunt saepe rem quibusdam earum suscipit harum quidem! Velit!";
    
    $post->save();

    return 'Updated!';

});



/*
|--------------------------------------------------------------------------
| Inserting & Updating Related Models.
|--------------------------------------------------------------------------
*/


Route::get('/create', function(){

    $post = Post::create(['title'=> 'Hi im new create fanctionalaty', 'body' => 'dolor sit amet consectetur adipisicing elit. Fuga, quis architecto']);

    return 'Create!';

});


Route::get('/update', function(){

    $post = Post::where('id',1)->where('is_admin', 0)->update(['title'=> 'Hi im new Update fanctionalaty']);

    return 'Updated!';

});


Route::get('/delete', function(){

    $post = Post::find(1);

    $post->delete();

    return 'Deleted!';

});


# Delete Many
Route::get('/deleteMany', function(){
    
    # this way
    Post::destroy([9,10,11]);

    # or this way
    Post::where('is_admin', 0)->delete();

    return 'Deleted many!';

    
});



/*
|--------------------------------------------------------------------------
| Soft Deleted.
|--------------------------------------------------------------------------
*/


Route::get('/softdelete', function(){
    
    Post::find(12)->delete();

    return 'Soft Deleted!';
    
});


Route::get('/readsoftdelete', function(){
    
    # with this Query can't show the Post was deleted.
      //$post = Post::find(12);
    
    # Hear can read Post of deleted.
    $post = Post::withTrashed()->where('id',12)->get();


    # or whit onlyTrashed.
    $post = Post::onlyTrashed()->where('is_admin',0)->get();

    return $post ;
    
});


Route::get('/restore', function(){

    Post::withTrashed()->where('is_admin',0)->restore();

    return 'Restored!' ;
    
});

# to Delete Column with Trashed use forceDelete.
Route::get('/forceDelete', function(){

    Post::onlyTrashed()->where('is_admin',0)->forceDelete();
    return 'force Deleted!' ;
    
});


/*
|--------------------------------------------------------------------------
| Eloquent with Relationships Tables.
|--------------------------------------------------------------------------
*/

# One to One relationship.
//////////////////////////
Route::get('post/{id}/user', function ($id) {

    return User::find($id)->getPost; // can chain also like : getPost->body
});

# Revers the Query
Route::get('user/{id}/post', function ($id) {

    return Post::find($id)->getUser; // can chain also like : getUser->name
});


# One to Many relationship.
//////////////////////////
Route::get('posts/{id}/user', function ($id) {

    return User::find($id)->getPosts;
});

Route::get('user/{id}/role', function ($id) {

    # $user = User::find($id);
    # $roles = User::find($id)->roles;
    
    $roles = DB::table('users')
                ->join('role_user', 'role_user.user_id', '=', 'users.id')
                ->join('roles', 'role_user.role_id', '=', 'roles.id')
                #->where('users.id', '=', 3)
                ->get(array(
                    'role', 'name'
                ));

    return $roles;
        
        

    
});


///////////////////////// Media Accessing 

Route::get('/country', function(){


    $country = DB::table('countries')
            ->join('users', 'users.country_id', '=' , 'countries.id')
            ->join('posts', 'posts.user_id', '=', 'users.id')
            ->get(array(
                'title',
                'body',
                'countries.name as country',
                'users.name'
    ));

                return $country;
    // $country = Country::find(3)->posts;
    // return $country;
    // foreach ($country as $name){
    //     echo $name->title . '<br>';
    // }
    
    
   

});