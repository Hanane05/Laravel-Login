<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\LocalizationController;

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





Route::get('/etudiants', [EtudiantController::class, 'index'])->name('etudiant.index')->middleware('auth');
Route::get('/etudiant-show/{etudiant}', [EtudiantController::class, 'show'])->name('etudiant.show')->middleware('auth');
Route::get('/etudiant-create', [EtudiantController::class, 'create'])->name('etudiant.create')->middleware('auth');
Route::post('/etudiant-create', [EtudiantController::class, 'store'])->name('etudiant.store')->middleware('auth');
Route::get('/etudiant-edit/{etudiant}', [EtudiantController::class, 'edit'])->name('etudiant.edit')->middleware('auth');
Route::put('etudiant-edit/{etudiant}', [EtudiantController::class, 'update'])->name('etudiant.update')->middleware('auth');
Route::delete('/etudiant-delete/{etudiant}', [EtudiantController::class, 'destroy'])->name('etudiant.delete')->middleware('auth');


Route::get('/files', [FileController::class, 'index'])->name('file.index')->middleware('auth');
Route::get('/file-create', [FileController::class, 'create'])->name('file.create')->middleware('auth');
Route::post('/file-create', [FileController::class, 'store'])->name('file.store')->middleware('auth');
Route::get('/file-show/{file}', [FileController::class, 'show'])->name('file.show')->middleware('auth');
Route::get('/file-edit/{file}', [FileController::class, 'edit'])->name('file.edit')->middleware('auth');
Route::put('file-edit/{file}', [FileController::class, 'update'])->name('file.update')->middleware('auth');
Route::delete('/file-delete/{file}', [FileController::class, 'destroy'])->name('file.delete')->middleware('auth');

Route::get('/lang/{locale}', [LocalizationController::class, 'index'])->name('lang')->middleware('auth');

Route::get('/', [ArticleController::class, 'index'])->name('forum.index')->middleware('auth');
Route::get('/article-create', [ArticleController::class, 'create'])->name('article.create')->middleware('auth');
Route::post('/article-create', [ArticleController::class, 'store'])->name('article.store')->middleware('auth');

Route::get('/forum/{article}', [ArticleController::class, 'show'])->name('article.show')->middleware('auth');
Route::get('/article-edit/{article}', [ArticleController::class, 'edit'])->name('article.edit')->middleware('auth');

Route::put('article-edit/{article}', [ArticleController::class, 'update'])->name('article.update')->middleware('auth');
Route::delete('/article-delete/{article}', [ArticleController::class, 'destroy'])->name('article.delete')->middleware('auth');



Route::get('/login', [CustomAuthController::class, 'index'])->name('user.login');
Route::post('/login', [CustomAuthController::class, 'authentication'])->name('user.authenticate');
Route::get('/logout', [CustomAuthController::class, 'logout'])->name('user.logout');
Route::get('/signup', [CustomAuthController::class, 'create'])->name('user.signup');
Route::post('/signup', [CustomAuthController::class, 'store'])->name('user.create');
