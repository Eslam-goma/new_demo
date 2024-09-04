<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PotentialCustomerController;
use App\Http\Controllers\BrokerController;
use App\Http\Controllers\ConventionTeamLeaderController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\TradeController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('brokers', BrokerController::class);
Route::apiResource('teamleaders', ConventionTeamLeaderController::class);
Route::apiResource('agents', AgentController::class);
Route::apiResource('leads', LeadController::class);

Route::apiResource('potential-customers', PotentialCustomerController::class);
Route::resource('trades', TradeController::class);
// Route::put('/trades/{id}', [TradeController::class, 'update']);
