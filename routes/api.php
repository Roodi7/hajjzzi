<?php

use App\Http\Controllers\AccommodationApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityApiController;
use App\Http\Controllers\ContactMailController;
use App\Http\Controllers\MainPageApiController;
use App\Http\Controllers\ReservationApiController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoomApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/accommodations', [AccommodationApiController::class, 'index']);

Route::get('/accommodations/{id}', [AccommodationApiController::class, 'show']);
Route::get('/accommodations/{id}/terms', [AccommodationApiController::class, 'terms']);
Route::get('/accommodations/{id}/rooms', [AccommodationApiController::class, 'rooms']);
Route::get('/accommodations/{id}/chalet-sections', [AccommodationApiController::class, 'rooms']);
Route::get('/accommodations/{id}/available-rooms', [AccommodationApiController::class, 'availableRooms']);
Route::get('/accommodations/{id}/reviews', [AccommodationApiController::class, 'reviews']);
Route::get('/accommodations/{id}/features', [AccommodationApiController::class, 'features']);
Route::get('/accommodations-by-city/{city_id}', [AccommodationApiController::class, 'accommodationsByCity']);


Route::get('/rooms/{room_id}', [RoomApiController::class, 'getRoom']);

Route::get('/cities', [CityApiController::class, 'index']);
Route::get('/city/{city_id}', [CityApiController::class, 'show']);

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('/cities', [CityApiController::class, 'index']);
Route::get('/main-sliders', [MainPageApiController::class, 'mainSliders']);
Route::get('/main-services', [MainPageApiController::class, 'mainServices']);
Route::get('/repeated-questions', [MainPageApiController::class, 'repeatedQuestions']);
Route::get('/social-icons', [MainPageApiController::class, 'socialIcons']);
Route::get('/terms-conditions', [MainPageApiController::class, 'PrivacyPolicies']);
Route::get('/policies', [MainPageApiController::class, 'Policies']);
Route::post('/send-contact-email', [ContactMailController::class, 'store']);
Route::get('/get-footer-info', [MainPageApiController::class, 'getFooterInfo']);


Route::get('/reservations-by-accommodation/{accommodation_id}', [ReservationApiController::class, 'reservationByAccommodation']);
Route::get('/reservations-by-room/{room_id}', [ReservationApiController::class, 'reservationByRoom']);
Route::get('/reservations-by-section/{section_id}', [ReservationApiController::class, 'reservationBySection']);
Route::get('/sections', [MainPageApiController::class, 'sections']);
Route::get('/get-ads', [MainPageApiController::class, 'getAds']);

Route::post('/review/store', [ReviewController::class, 'storeReview']);

Route::get('/accommodations/{accommodationId}/rooms', [ReservationApiController::class, 'getRooms']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('/reservations', [ReservationApiController::class, 'store']);
    Route::get('/reservations', [ReservationApiController::class, 'index']);


});

Route::get('/get-csrf', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});
