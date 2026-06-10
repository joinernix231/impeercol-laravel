<?php

use App\Http\Controllers\Api\AgentTechnicalSheetController;
use Illuminate\Support\Facades\Route;

Route::prefix('agent/technical-sheets')
    ->middleware('agent.token')
    ->group(function () {
        Route::get('/pending', [AgentTechnicalSheetController::class, 'pending']);
        Route::post('/resolve-mapei', [AgentTechnicalSheetController::class, 'resolveMapei']);
        Route::post('/assign', [AgentTechnicalSheetController::class, 'assign']);
    });
