<?php

use App\Http\Controllers\EncyklopedieController;
use App\Http\Controllers\KytkaController;
use App\Http\Controllers\NastaveniController;
use App\Http\Controllers\NomenklaturaController;
use App\Http\Controllers\SouboryController;
use Illuminate\Support\Facades\Route;

Route::resource('nomenklatura', NomenklaturaController::class);
Route::resource('soubory', SouboryController::class);
Route::resource('encyklopedie', EncyklopedieController::class);
Route::get('encyklopedie-nesparovane', [EncyklopedieController::class, 'unpaired']);
Route::resource('kytka', KytkaController::class);
Route::get('soubory/{id}/stahnout', [SouboryController::class, 'download']);
Route::get('soubory/{id}/duplicity', [SouboryController::class, 'deduplicate']);
Route::get('soubory/{id}/nesparovane', [SouboryController::class, 'unpaired']);
Route::get('encyklopedie-stahnout', [EncyklopedieController::class, 'download']);
Route::get('nastaveni', [NastaveniController::class, 'index']);

Route::redirect('/', 'soubory');
