<?php

use App\Http\Controllers\AccommodationsController;
use App\Http\Controllers\AddFeatureController;
use App\Http\Controllers\AddRoomController;
use App\Http\Controllers\AddTermController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ChaletSectionController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ContactMailController;
use App\Http\Controllers\ContactSectionInfoController;
use App\Http\Controllers\DiscountAndMarketingController;
use App\Http\Controllers\FeaturesController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MainPageServicesController;
use App\Http\Controllers\MainPageSliderController;
use App\Http\Controllers\ManageUsersController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\RepeatedQuestionsController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReservationManagementController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SocialMediaIconsController;
use App\Http\Controllers\TermsController;
use App\Models\MainPageServices;
use App\Models\MainPageSlider;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/home', function () {
    return view('home');
});

Auth::routes();
Route::middleware(['auth'])->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('city', CityController::class);
    Route::resource('accomodation', AccommodationsController::class);
    Route::get('accomodations/{accommodation_type}', [AccommodationsController::class, 'index'])->name('accomodations.index');
    Route::get('accomodations/create/{accommodation_type}', [AccommodationsController::class, 'create'])->name('accomodations.create');

    Route::resource('feature', FeaturesController::class);
    Route::resource('term', TermsController::class);
    Route::get('add_feature/accomodation/{accommodation}', [AddFeatureController::class, 'accommodation'])->name('accommodation.add_feature');
    Route::post('add_feature/accomodation/{accommodation}', [AddFeatureController::class, 'accommodationAddFeature'])->name('accommodation.add_feature_post');
    Route::delete('add_feature/accomodation/{accommodationFeature}', [AddFeatureController::class, 'accommodationDeleteFeature'])->name('accommodation.delete_feature');

    Route::get('add_term/accomodation/{accommodation}', [AddTermController::class, 'accommodation'])->name('accommodation.add_term');
    Route::post('add_term/accomodation/{accommodation}', [AddTermController::class, 'accommodationAddTerm'])->name('accommodation.add_term_post');
    Route::delete('add_term/accomodation/{accommodationTerm}', [AddTermController::class, 'accommodationDeleteTerm'])->name('accommodation.delete_term');

    Route::get('add_room/accomodation/{accommodation}', [AddRoomController::class, 'accommodation'])->name('accommodation.add_room');
    Route::post('add_room/accomodation/{accommodation}', [AddRoomController::class, 'accommodationAddRoom'])->name('accommodation.add_room_post');
    Route::delete('add_room/accomodation/{accommodationRoom}', [AddRoomController::class, 'accommodationDeleteRoom'])->name('accommodation.delete_room');
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/hotels/{hotelId}/rooms', [ReservationController::class, 'getRooms'])->name('getRooms');

    Route::get('/reservations/print-search', [ReservationController::class, 'print_search'])->name('reservations.print_search');




    //reservation
    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::put('/reservations/{id}', [ReservationController::class, 'update'])->name('reservations.update');
    Route::post('/reservations/accept/{id}', [ReservationController::class, 'accept'])->name('reservations.accept');
    Route::post('/reservations/deny/{id}', [ReservationController::class, 'deny'])->name('reservations.deny');
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::get('/reservations/{reservation}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');


    Route::get('/reports/accommodations/{id}', [ReportController::class, 'showAccommodationReport'])->name('reports.accommodations');
    Route::get('/reports/rooms/{id}', [ReportController::class, 'showRoomReport'])->name('reports.rooms');

    Route::get('add_feature/room/{room}', [AddFeatureController::class, 'roomFeatures'])->name('room.add_feature');
    Route::post('add_feature/room/{room}', [AddFeatureController::class, 'roomAddFeature'])->name('room.add_feature_post');
    Route::delete('add_feature/room/{roomFeature}', [AddFeatureController::class, 'roomDeleteFeature'])->name('room.delete_feature');

    Route::get('/chalet-section/create/{chalet_id}', [ChaletSectionController::class, 'index'])->name('chalet_section.create');
    Route::post('/chalet-section/create', [ChaletSectionController::class, 'store'])->name('chalet_section.store');
    Route::delete('/chalet-section/create/{chalet_id}', [ChaletSectionController::class, 'destroy'])->name('section.delete');

    Route::get('add_feature/chaletsection/{chaletsection}', [AddFeatureController::class, 'chaletsectionFeatures'])->name('chaletsection.add_feature');
    Route::post('add_feature/chaletsection/{chaletsection}', [AddFeatureController::class, 'chaletsectionAddFeature'])->name('chaletsection.add_feature_post');
    Route::delete('add_feature/chaletsection/{chalet_section_feature_id}', [AddFeatureController::class, 'chaletsectionDeleteFeature'])->name('chaletsection.delete_feature');
    Route::resource('main-slider', MainPageSliderController::class);
    Route::resource('main-services', MainPageServicesController::class);
    Route::resource('repeated-questions', RepeatedQuestionsController::class);
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::post('/reports/show', [ReportController::class, 'show'])->name('reports.show');
    Route::resource('/discount_and_marketing', DiscountAndMarketingController::class);
    Route::resource('privacy-policy', PrivacyPolicyController::class);
    Route::resource('policy', PolicyController::class);
    Route::resource('social-icons', SocialMediaIconsController::class);
    Route::resource('contactSectionInfo', ContactSectionInfoController::class);
    Route::resource('reviews', ReviewController::class)->middleware('isAdmin');


    Route::get('/manage-ads', [DiscountAndMarketingController::class, 'index']);



    Route::resource('contact-mails', ContactMailController::class);
    Route::get('contact-mails/{id}/reply', [ContactMailController::class, 'reply'])->name('contact-mails.reply');
    Route::post('contact-mails/{id}/reply', [ContactMailController::class, 'sendReply'])->name('contact-mails.sendReply');
    Route::get('users', [ManageUsersController::class, 'index'])->name('user.index');
    Route::get('all-users', [ManageUsersController::class, 'allUsers'])->name('all_users.index');
    Route::get('user/edit/{user_id}', [ManageUsersController::class, 'edit'])->name('user.edit');
    Route::post('user/edit/{user_id}', [ManageUsersController::class, 'update'])->name('user.update');
    Route::get('create-user', [ManageUsersController::class, 'create'])->name('user.create');
    Route::get('managers', [ManageUsersController::class, 'managers'])->name('user.managers');
    Route::get('create-accommodation-manager', [ManageUsersController::class, 'accommodationManagerCreate'])->name('accommodation_manager.create');
    Route::post('create-accommodation-manager', [ManageUsersController::class, 'accommodationManagerPost'])->name('accommodation_manager.post');
    Route::delete('accommodation-manager/delete/{user_id}', [ManageUsersController::class, 'managerDestroy'])->name('accommodation_manager.destroy');

    Route::post('user/create', [ManageUsersController::class, 'createUser'])->name('user.store');
    Route::delete('user/delete/{user_id}', [ManageUsersController::class, 'destroy'])->name('user.destroy');

    Route::get('/sections/edit', [SectionController::class, 'edit'])->name('sections.edit');
    Route::put('/sections/update', [SectionController::class, 'update'])->name('sections.update');



});