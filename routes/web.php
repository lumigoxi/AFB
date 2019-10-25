<?php




//route for landing page
Route::get('/', 'frontController@index')->name('/');
Route::resource('pages', 'AllPageController')->only(['update', 'show']);

//register route disabled because can't a person register own  
Auth::routes(['register'=>false]);

Route::get('/dashboard', 'HomeController@index')->name('dashboard');
//Rputes for dashboard
Route::get('miembros/getAllUser', 'memberController@getAll');
Route::resource('miembros', 'memberController')->except(['create', 'edit']);
//Routes for web site. 
Route::group(['prefix'=> '/'], function(){
	Route::get('/historias', 'frontController@storyView');
	Route::get('adoptar', 'frontController@adoptView');
	Route::get('getAllPets', 'frontController@getAllPets');
	Route::get('getAllStory', 'frontController@getAllStory');
	Route::get('actividades', 'frontController@activityView');
	Route::get('contactanos', 'frontController@contactView');
});
Route::post('contactanos/formContact', 'InputMessageController@store');
//Route type resource for CRUD 
Route::resource('/dashboard/landing', 'LandingController')->except(['create', 'edit']);
Route::resource('/dashboard/mision-vision', 'misionVisionController');
Route::get('/dashbaord/getAllStories', 'StoryController@getAll');
Route::resource('/dashboard/historias', 'StoryController')->except(['create', 'edit']);
Route::get('actividades/getAllActivitys', 'ActivityController@getAll');
Route::resource('/dashboar/actividades/imagenes', 'ActivityPictureController')->except(['create', 'edit']);
Route::resource('/dashboard/actividades', 'ActivityController')->except(['create', 'edit']);
Route::get('rescue/getAllRescues', 'RescueController@getAll');
Route::resource('/dashboard/rescates', 'RescueController')->except(['create']);
Route::get('getPetStory', 'RequestPetController@getOnlyAdopted');
Route::get('pet/getAllPet', 'PetController@getAll');
Route::resource('dashboard/cms-mascotas', 'cmsPetController')->except(['create']);
Route::resource('dashboard/Mascotas', 'PetController')->except(['create']);
Route::resource('dashboard/Fotos-Mascota', 'PetPictureController')->except(['create']);
Route::resource('dahsboard/cms-miembros', 'cmsMemberController')->except(['create']);
Route::resource('dashboard/Mensajes', 'MessageController')->except(['create', 'edit']);
Route::get('Messages/getAllMessages', 'MessageController@getAll');
Route::get('dashboard/tasks/getMyTasks', 'TaskController@getMyTasks');
Route::resource('dashboard/Tareas', 'TaskController')->only(['index', 'update', 'show']);
Route::post('adoptar/formAdopt', 'InputRequestPetController@store')->name('requestPetStore');
Route::get('requestsPet', 'RequestPetController@getAll');
Route::resource('dashboard/Solicitudes', 'RequestPetController');
Route::resource('dashboard/historiass/historia-imagen', 'StoryPictureController')
			->except(['index', 'edit', 'create']);
Route::get('getOneStory', 'frontController@getOneStory');
Route::get('getOnePet', 'frontController@getOnePet');
Route::get('getAllActivities', 'frontController@getAllActivities');
Route::get('getOneActivity', 'frontController@getOneActivity');
Route::resource('addPageImage', 'PageImageController')->only(['store', 'update', 'show', 'destroy']);
Route::resource('cms-contactanos', 'ContactUsController')->except(['edit', 'create', 'store']);
Route::get('/control', 'HomeController@control');