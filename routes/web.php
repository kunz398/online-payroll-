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

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/add_emp', 'DashBoardController@redirectAddUserIndex')->name('add_emp');
Route::post('/store_emp', 'AddUserController@store')->name('register_new_emp');
Route::post('/other_emp_details', 'AddUserController@other_emp_details')->name('other_emp_details');
Route::get('/deductionForm/{id}', 'AddUserController@deductionForm')->name('deductionForm');
Route::post('/updateDeduction', 'AddUserController@updateDeduction')->name('updateDeduction');
Route::get('/view_emp', 'DashBoardController@redirectviewEmp')->name('view_emp');
Route::post('/ajaxs_edit_emp', 'AddUserController@AjaxsEditEmp')->name('edit_emp');
Route::post('/update_emp', 'AddUserController@update_emp')->name('update_emp');
Route::post('/delete_emp', 'AddUserController@deleteEmp')->name('delete_emp');
Route::get('/calc', 'DashBoardController@redirectIndexCalc')->name('index.calc');
Route::post('/pickUsersCalcPay', 'AddUserController@pickUsersCalcPay')->name('post.calc.pick.user');