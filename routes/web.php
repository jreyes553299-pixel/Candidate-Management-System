<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CandidateController;

Route::get('/', function () {
    return redirect()->route('candidates.index');
});

Route::resource('candidates', CandidateController::class)->except(['create', 'show']);
Route::get('/candidates/{candidate}/delete', [CandidateController::class, 'destroy'])->name('candidates.delete');
