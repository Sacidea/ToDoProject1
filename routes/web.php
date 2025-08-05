<?php

//bu dosya ile route ları oluşturuyoruz 
//hangi html dosyasına hangi url ile gidilecek(resources de view kısmında oluşturduğumuz html sayfalarına route name ile gösteriyoruz)
//Hangi controller sımıfı ve bu sınıfta hangi metodu kullanılacağı(view, return, validasyon  )

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController; 
use Illuminate\Support\Facades\Route;


Route::get('/', function () {  //Localhost ilk çıkan laravel sayfası
    return view('welcome');
});


Route::get('/temp',function(){
    return view('panel.layout.app');//her html sayfasında  bulunacak kısım(menü, navbar vs.)
});

//task routers start
Route::get('/panel/tasks/create',[TaskController::class, 'createPage'])->name('panel.createTaskPage');//task oluşturma sayfası
Route::post('/panel/tasks/add',[TaskController::class, 'addTask'])->name('panel.addTask');//
Route::get('/panel/tasks/index' ,[TaskController::class, 'indexPage'])->name('panel.indexTask');  

//task routers end

//kategoriler roters start
Route::get('/panel/categories/index' ,[CategoryController::class, 'index'])->name('panel.categoryindex');//Kategori listesinin olduğu sayfa
Route::get('/panel/categories/createPage' ,[CategoryController::class, 'createPage'])->name('panel.categoryCreatePage');
Route::post('/panel/categories/addCategory' ,[CategoryController::class, 'postCategory'])->name('panel.categoryAdd');
Route::get('/panel/categories/update/{id}' ,[CategoryController::class, 'updatePage'])->name('panel.categoryUpdatePage');
               // {id} yi url ye güncelle butonu düzenlemeleri sırasında her data bilgisinin güncelleme sayfasını
              //açması için adrese ekledik aksi halde hep aynı sayfa açılırdı
Route::post('/panel/categories/updatePost' ,[CategoryController::class, 'updateCategory'])->name('panel.updateCategory');
Route::get('/panel/categories/delete/{id}' ,[CategoryController::class, 'categoryDelete'])->name('panel.categoryDelete');            

//kategoriler routers end


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
