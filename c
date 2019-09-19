[1mdiff --git a/routes/web.php b/routes/web.php[m
[1mindex b3cdf1d..75b9687 100644[m
[1m--- a/routes/web.php[m
[1m+++ b/routes/web.php[m
[36m@@ -1,33 +1,47 @@[m
 <?php[m
[31m-[m
[31m-/*[m
[31m-|--------------------------------------------------------------------------[m
[31m-| Web Routes[m
[31m-|--------------------------------------------------------------------------[m
[31m-|[m
[31m-| Here is where you can register web routes for your application. These[m
[31m-| routes are loaded by the RouteServiceProvider within a group which[m
[31m-| contains the "web" middleware group. Now create something great![m
[31m-|[m
[31m-*/[m
[31m-[m
[32m+[m[32m//route for landing page[m
 Route::get('/', function () {[m
     return view('welcome');[m
 })->name('/');[m
 [m
[32m+[m[32m//register route disabled because can't a person register own[m[41m  [m
 Auth::routes(['register'=>false]);[m
 [m
[32m+[m[32m//Rputes for dashboard[m
 Route::get('dashboard', 'HomeController@index')->name('dashboard');[m
[31m-Route::resource('miembros', 'memberController')->except(['create', 'edit', 'show']);[m
[31m-Route::get('miembros/getAllUser', 'memberController@getAll');[m
[31m-Route::delete('miembros/eliminar-miembro/{id}', 'memberController@deleteMember')->name('deleteMember');[m
[32m+[m
[32m+[m[32m//Routes for web site.[m[41m [m
 Route::group(['prefix'=> '/'], function(){[m
[31m-	Route::get('/historias', 'frontController@storyView');[m
[32m+[m	[32mRoute::get('historias', 'frontController@storyView');[m
 	Route::get('adoptar', 'frontController@adoptView');[m
 	Route::get('actividades', 'frontController@activityView');[m
 });[m
[31m-Route::resource('/dashboard/historias', 'StoryController')->except(['create', 'edit', 'show']);[m
 [m
 [m
[32m+[m[32m//Route type resource for CRUD[m[41m [m
[32m+[m[32mRoute::resource('miembros', 'memberController')->except(['create', 'edit', 'show']);[m
[32m+[m[32mRoute::get('miembros/getAllUser', 'memberController@getAll');[m
[32m+[m[32mRoute::delete('miembros/eliminar-miembro/{id}', 'memberController@deleteMember')->name('deleteMember');[m
[32m+[m[32mRoute::resource('/dashboard/historias', 'StoryController')->except(['create', 'edit', 'show']);[m
 Route::get('actividades/getAllActivitys', 'ActivityController@getAll');[m
 Route::resource('/dashboard/actividades', 'ActivityController')->except(['create', 'edit']);[m
[32m+[m[32mRoute::get('rescue/getAllRescues', 'RescueController@getAll');[m
[32m+[m[32mRoute::resource('/dashboard/rescates', 'RescueController')->except(['create', 'edit']);[m
[32m+[m[32mRoute::resource('dashboard/', 'Controller')->except(['create']);[m
[32m+[m
[32m+[m
[32m+[m[32mRoute::resource('dashboard/Patrocinadores', 'SponsorController')->except(['create']);[m
[32m+[m[32mRoute::resource('dashboard/Pagos-Patrocinador', 'SponsorActivityController')->except(['create']);[m
[32m+[m[32mRoute::resource('dashboard/Cobros', 'InputPayController')->except(['create']);[m
[32m+[m[32mRoute::resource('dashboard/Caja', 'CashController')->except(['create']);[m
[32m+[m[32mRoute::resource('dashboard/Donaciones', 'DonationController')->except(['create']);[m
[32m+[m[32mRoute::resource('dashboard/Peticion-Adopcion', 'RequestRescueController')->except(['create']);[m
[32m+[m[32mRoute::resource('dashboard/Pagos', 'OutputPayController')->except(['create']);[m
[32m+[m[32mRoute::resource('dashboard/Mascotas', 'PetController')->except(['create']);[m
[32m+[m[32mRoute::resource('dashboard/Solicitud-Adopcion', 'RequestRescueController')->except(['create']);[m
[32m+[m[32mRoute::resource('dashboard/Amigos', 'PersonController')->except(['create']);[m
[32m+[m[32mRoute::resource('dashboard/Hospedaje', 'LodgingController')->except(['create']);[m
[32m+[m[32mRoute::resource('dashboard/Voluntarios', 'VoluntaryController')->except(['create']);[m
[32m+[m[32mRoute::resource('dashboard/Tratamientos', 'TreatmentController')->except(['create']);[m
[32m+[m[32mRoute::resource('dashboard/Veterinarios', 'vetController')->except(['create']);[m
[41m+[m
