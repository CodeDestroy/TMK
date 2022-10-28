<?php



use Illuminate\Support\Facades\Route;

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


Route::get('/', 'App\Http\Controllers\MainController@getAllInfo');


Route::get('/services', 'App\Http\Controllers\ServicesController@getAllServices');
Route::get('/services/{id}', 'App\Http\Controllers\ServicesController@getServicesById');

Route::get('/news', 'App\Http\Controllers\NewsController@getAllNews');
Route::get('/news/{id}', 'App\Http\Controllers\NewsController@getNewsById');

Route::get('/partners', 'App\Http\Controllers\PartnersController@getAllPartners');


Route::get('/contacts', 'App\Http\Controllers\ContactsController@getAllContacts');

Route::get('/products', 'App\Http\Controllers\ProductionController@getAllProducts');
Route::get('/products/{product_type}', 'App\Http\Controllers\ProductionController@getAllProductsByType');
Route::get('/products/{product_type}/{id}', 'App\Http\Controllers\ProductionController@getProductsById');

//Route::get('/category/{category}', 'App\Http\Controllers\SubCategoriesController@getSubCategoryById');
Route::get('/category/{category}/{sub_category}', 'App\Http\Controllers\SubCategoriesController@getSubCategoryById');



Route::post('/submit', 'App\Http\Controllers\SubmitController@sentSebmit')->name('contact-form');
