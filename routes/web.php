<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\GovernateController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ContactController;

use App\Models\Shipment;


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
    //^ Frontend Routes
    //! 001 => Auth Routes
        Route::get('login' ,[AuthController::class,'login'])->name('login');
        Route::post('login' ,[AuthController::class,'loginStore'])->name('login.store');
        Route::get('register' , [AuthController::class,'register'])->name('user.register');
        Route::post('register' ,[AuthController::class,'registerStore'])->name('register.store');
        Route::get('logout' , [AuthController::class,'logout'])->name('logout');
        Route::get('reset' , [AuthController::class,'resetPassword'])->name('user.reset');


    //! 002 => General Routes
        Route::get('/' , [HomeController::class,'index'])->name('site.home');
        Route::get('about' , [HomeController::class,'about'])->name('site.about');
        Route::get('branchs' , [HomeController::class,'branchs'])->name('site.branchs');

    //! 003 => Profile Routes
    Route::middleware('auth:sanctum')->group(function(){
    Route::get('profile' , [UserProfileController::class,'edit'])->name('user.profile');
    Route::put('profile/update' , [UserProfileController::class ,'UpdateUserMainData'])->name('user.profile.update');
    Route::put('profile/Imageupdate' , [UserProfileController::class ,'UpdateProfileImage'])->name('user.updateProfileImage');
    Route::post('profile/address/create' , [UserProfileController::class ,'CreateUserAddress'])->name('user.address.create');
    Route::get('profile/address/edit/{id}' , [UserProfileController::class ,'editAddress'])->name('user.address.edit');
    Route::put('profile/address/update/{id}' , [UserProfileController::class ,'updateUserAddress'])->name('user.address.update');
    Route::get('profile/address/delete/{id}' , [UserProfileController::class ,'deleteUserAddress'])->name('user.address.delete');

    //! 004 => Shipments Routes
        Route::get('shipments' , [ShipmentController::class,'userShipments'])->name('shipment.list');

    });
    Route::get('shipments_details/{id}' , [ShipmentController::class,'ShipmentTrackDetails'])->name('shipment.details');
    Route::get('shipments/track' , [ShipmentController::class,'trackPage'])->name('shipment.track');
    Route::post('shipment/track' , [ShipmentController::class,'trackOrder'])->name('track.order');
    Route::get('shipment/create' , [ShipmentController::class,'createShipment'])->name('shipment.create');
    Route::post('shipment/store' , [ShipmentController::class,'StoreShipment'])->name('shipment.store');

    //! 005 => Notifications Routes
    Route::middleware('auth:sanctum')->group(function(){
    Route::get('/notifications', [UserController::class, 'notifications'])->name('user.notifications');
    Route::post('/notifications/{id}/read', [UserController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [UserController::class, 'markAllAsRead'])->name('notifications.readAll');
    //! 006 => Contact Routes
    Route::get('contact' , [ContactController::class,'create'])->name('site.contact');
    Route::post('contact' , [ContactController::class,'store'])->name('site.contact.store');

    });


    //! 007 => Error Handling
    Route::fallback(function () {
        return view('Frontend.error404');
    });

    //! 008 => get cities by fetch using ajax js
    Route::get('/get-cities/{governate}', [UserProfileController::class, 'getCities']); //! Used in ajax to get data depend on Governate



    //^ Admin Routes
    Route::middleware('auth:sanctum' , 'isAdmin')->prefix('dashboard')->group( function(){
    //! 001 => Dashboard Main page Route
    Route::get('main' ,[DashboardController::class,'dashboard'])->name('dashboard.main');

    //! 002 => Users Managment Routes
    Route::get('client' , [UserController::class,'index'])->name('dashboard.users');
    Route::get('client/{id}' ,[UserController::class,'show'])->name('users.show');
    Route::delete('client/{id}/delete' ,[UserController::class,'delete'])->name('users.delete');


    //! 003 Shipments Managment Routes
    Route::get('shipments',[ShipmentController::class,'ShipmentDashboard'])->name('dashboard.shipments');
    Route::get('shipments/{id}/show',[ShipmentController::class,'TrackDetailsDashboard'])->name('shipment.show');
    Route::get('shipments/{id}/edit',[ShipmentController::class,'edit'])->name('shipment.edit');
    Route::put('shipment/{id}/status',[ShipmentController::class,'statusChange'])->name('shipment.status');
    Route::put('shipment/{id}/details/update',[ShipmentController::class,'shipmentDetailsUpdate'])->name('shipment.Update');
    Route::delete('shipments/{id}/delete' , [ShipmentController::class,'delete'])->name('shipment.delete');

    //! 004 Testimonails Managment Routes
    Route::get('testimonails' , [TestimonialController::class,'index'])->name('dashboard.testimonails');
    Route::get('testimonail/create' , [TestimonialController::class,'create'])->name('testimonail.create');
    Route::post('testimonail/store' , [TestimonialController::class,'store'])->name('testimonail.store');
    Route::get('testimonail/{id}' , [TestimonialController::class,'show'])->name('testimonail.show');
    Route::get('testimonail/{id}/edit' , [TestimonialController::class,'edit'])->name('testimonail.edit');
    Route::put('testimonail/{id}/update' , [TestimonialController::class,'update'])->name('testimonail.update');
    Route::delete('testimonail/{id}/delete' , [TestimonialController::class,'destroy'])->name('testimonail.delete');

    //! 005 Locations Managment Routes
     //^ City Routes
     Route::resource('cities', CityController::class);

     //^ Governorate Routes
     Route::resource('governorates', GovernateController::class);

     //^ Area Routes
     Route::resource('areas', AreaController::class);

    //! 006 Partners Managment Routes
     Route::resource('partners', PartnerController::class);

    //! 007 Logs Manangment Routes
     Route::get('activity-logs', [DashboardController::class, 'viewActivityLogs'])->name('admin.activity-logs');
     Route::delete('activity-log/{id}', [DashboardController::class, 'destroy'])->name('admin.delete.logs');

    //! 008 Contact Manangment Routes
    Route::get('contact' , [ContactController::class,'index'])->name('contact.index');
    Route::get('contact/{id}' , [ContactController::class,'show'])->name('contact.show');
    Route::delete('contact/{id}/delete' , [ContactController::class,'delete'])->name('contact.delete');


});

