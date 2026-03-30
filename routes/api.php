<?php

use App\Http\Controllers\Api\AssistantApplicationController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::apiResource('applications', AssistantApplicationController::class);
});
