<?php

use Illuminate\Support\Facades\Storage;



//route for landing page
Route::get('/', 'frontController@index')->name('/');
Route::resource('pages', 'AllPageController')->only(['update', 'show']);

//register route disabled because can't a person register own  
Auth::routes(['register'=>false]);

Route::get('/dashboard', 'HomeController@index')->name('dashboard');
//Rputes for dashboard
Route::get('miembros/getAllUser', 'memberController@getAll');
Route::resource('miembros', 'memberController')->except(['create', 'edit']);
Route::delete('miembros/eliminar-miembro/{id}', 'memberController@deleteMember')->name('deleteMember');
//Routes for web site. 
Route::group(['prefix'=> '/'], function(){
	Route::get('/historias', 'frontController@storyView');
	Route::get('adoptar', 'frontController@adoptView');
	Route::get('actividades', 'frontController@activityView');
});

//Route type resource for CRUD 
Route::resource('/dashboard/landing', 'LandingController')->except(['create', 'edit']);
Route::resource('/dashboard/mision-vision', 'misionVisionController');
Route::resource('/dashboard/historias', 'StoryController')->except(['create', 'edit', 'show']);
Route::get('actividades/getAllActivitys', 'ActivityController@getAll');
Route::resource('/dashboard/actividades', 'ActivityController')->except(['create', 'edit']);
Route::get('rescue/getAllRescues', 'RescueController@getAll');
Route::resource('/dashboard/rescates', 'RescueController')->except(['create']);
Route::resource('dashboard/Patrocinadores', 'SponsorController')->except(['create']);
Route::resource('dashboard/Pagos-Patrocinador', 'SponsorActivityController')->except(['create']);
Route::resource('dashboard/Cobros', 'InputPayController')->except(['create']);
Route::resource('dashboard/Caja', 'CashController')->except(['create']);
Route::resource('dashboard/Donaciones', 'DonationController')->except(['create']);
Route::resource('dashboard/Peticion-Adopcion', 'RequestRescueController')->except(['create']);
Route::resource('dashboard/Pagos', 'OutputPayController')->except(['create']);
Route::get('pet/getAllPet', 'PetController@getAll');
Route::resource('dashboard/cms-mascotas', 'cmsPetController')->except(['create']);
Route::resource('dashboard/Mascotas', 'PetController')->except(['create']);
Route::resource('dashboard/Fotos-Mascota', 'PetPictureController')->except(['create']);
Route::resource('dashboard/Solicitud-Adopcion', 'RequestRescueController')->except(['create']);
Route::resource('dashboard/Amigos', 'PersonController')->except(['create']);
Route::resource('dashboard/Hospedaje', 'LodgingController')->except(['create']);
Route::resource('dashboard/Voluntarios', 'VoluntaryController')->except(['create']);
Route::resource('dashboard/Tratamientos', 'TreatmentController')->except(['create']);
Route::resource('dashboard/Veterinarios', 'vetController')->except(['create']);
Route::resource('dahsboard/cms-miembros', 'cmsMemberController')->except(['create']);

