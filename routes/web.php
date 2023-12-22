<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::name('todo.')->group(function () {
    Route::get('/todo', \App\Livewire\Todo\Index::class)->name('index');
});
