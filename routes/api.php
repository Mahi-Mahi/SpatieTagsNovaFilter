<?php


use Mahi\SpatieTagsNovaFilter\AutocompleteController;
use Illuminate\Support\Facades\Route;

Route::post('/tags', [AutocompleteController::class, 'tags']);