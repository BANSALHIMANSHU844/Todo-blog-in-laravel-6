<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Routes;
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

Route::get('/', function () {
    $todos=Db::table('todos')
    ->join('users','todos.user_id','=','users.id')
    ->select('todos.title','todos.description','todos.created_at','users.name')
    ->paginate(5);
    return view('welcome',compact('todos'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home','HomeController@upload');



Route::group(['middleware' => 'auth'], function () {
    Route::resource('/todo', 'TodoController');
  });