<?php

use App\Http\Controllers\EncyklopedieController;
use App\Http\Controllers\KytkaController;
use App\Http\Controllers\NastaveniController;
use App\Http\Controllers\NomenklaturaController;
use App\Http\Controllers\SouborDuplicityController;
use App\Http\Controllers\SouborStahnoutController;
use App\Http\Controllers\SouboryController;
use Illuminate\Support\Facades\Route;

Route::resource('nomenklatura', NomenklaturaController::class);
Route::resource('soubory', SouboryController::class);
Route::resource('encyklopedie', EncyklopedieController::class);
Route::get('encyklopedie-nesparovane', [EncyklopedieController::class, 'unpaired']);
Route::resource('kytka', KytkaController::class);
Route::get('soubory/{id}/stahnout', SouborStahnoutController::class);
Route::get('soubory/{id}/duplicity', SouborDuplicityController::class);
Route::get('nastaveni', [NastaveniController::class, 'index']);

Route::redirect('/', 'soubory');
