<?php

use Api\ApiMessage;
use Api\ApiPortfolios;
use Api\ApiInvestments;
use Api\ApiDashboard;
use Api\ApiActivity;
use Api\ApiWithdrawalRequest;
use Api\ApiWithdrawalHistory;
use Api\ApiUser;
use Api\ApiEditPassword; 
use Api\ApiReinvestment; 
use Api\ApiReferredUsers;
use Api\ApiReferralBonus;  
use Api\ApiResources;
use Api\ApiTransfer;
use App\Http\Controllers\Api\ApiAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::middleware('auth:sanctum')->group( function () {

});
 
Route::post('verifyuser', [ApiAuth::class, 'verifyuser']); 
Route::post('login', [ApiAuth::class, 'login']);
Route::post('register', [ApiAuth::class, 'register']); 
Route::post('resend-code', [ApiAuth::class, 'resendcode']);

Route::get('get-resources', [ApiAuth::class, 'getResources']);
 
Route::apiResource("messages", ApiMessage::class);
Route::apiResource("portfolios", ApiPortfolios::class);
Route::apiResource("investments", ApiInvestments::class);
Route::apiResource("dashboard", ApiDashboard::class);
Route::apiResource("activities", ApiActivity::class);
Route::apiResource("withdrawal-request", ApiWithdrawalRequest::class);
Route::apiResource("withdrawal-history", ApiWithdrawalHistory::class);
Route::apiResource("user", ApiUser::class); 
Route::apiResource("update-password", ApiEditPassword::class); 
Route::apiResource("purchase-investment", ApiPortfolios::class); 
Route::apiResource("reinvest", ApiReinvestment::class);
Route::apiResource("partners", ApiReferredUsers::class); 
Route::apiResource("bonus", ApiReferralBonus::class);
Route::apiResource("account-transfer", ApiTransfer::class);
Route::get('/clear', function() {

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');

    return "Cleared!";

 });

