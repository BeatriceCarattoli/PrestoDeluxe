<?php

 
use App\Actions\Fortify\EditUserProfileInformation;
use App\Http\Controllers\userProfile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RevisorController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\AnnouncementController;
use App\Actions\Fortify\UpdateUserProfileInformation;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[PageController::class, 'home'])->name('welcome');

Route::get('/nuovo/annuncio',[AnnouncementController::class, 'createAnnouncement'])->middleware('auth')->name('announcements.create');
Route::delete('anunncio/{Announcement}',[userProfile::class,'destroyAd'])->name('destroy_Ad');
//Rotta parametrica delle categorie uttilizzata per passare (category) e prendere tutti gli articoli della singola categoria
Route::get('/categoria/{category}',[PageController::class,'categoryShow'])->name('categoryShow');
//Rotta parametrica per la pagina dettaglio del singolo annuncio
Route::get('/dettaglio/annuncio/{announcement}',[AnnouncementController::class,'showAnnouncement'])->name('announcements.show');
//rotta per mostrare tutti gli annunci presenti nel sito
Route::get('/tutti/annunci',[AnnouncementController::class,'indexAnnouncement'])->name('announcements.index');
//home revisore
Route::get('/revisor/home',[RevisorController::class,'index'])->middleware('IsRevisor')->name('revisor.index');
//Rotta accetta annuncio
Route::patch('/accetta/annuncio/{announcement}',[RevisorController::class,'acceptAnnouncement'])->middleware('IsRevisor')->name('revisor.accept_announcement');
//Rotta rifiuta annuncio
Route::patch('/rifiuta/annuncio/{announcement}',[RevisorController::class,'rejectAnnouncement'])->middleware('IsRevisor')->name('revisor.reject_announcement');

Route::patch('/recupera/annuncio{announcement}',[RevisorController::class,'recoverAnnouncement'])->middleware('IsRevisor')->name('revisor.recover_announcement');
//rotta per richiedere di diventare revisore 
//Collegato anche middleware auth per risalire all'utente registrato (footer)
Route::get('/richiesta/revisore',[RevisorController::class,'becomeRevisor'])->middleware('auth')->name('become.revisor');
// rotta della mail, per rendere un utente revisore
Route::get('/rendi/revisore{user}',[RevisorController::class,'makeRevisor'])->name('make.revisor');

Route::get('/ricerca/annuncio',[PageController::class,'searchAnnouncements'])->name('announcements.search');

Route::post('/lingua/{lang}', [PageController::class, 'setLanguage'])->name('set_language_locale');
//profilo utente
Route::get('profiloUtente',[userProfile::class,'UserProfile'])->name('user_profile');

Route::get('/profile/edit', [UpdateUserProfileInformation::class, 'edit'])->name('profile.edit');


