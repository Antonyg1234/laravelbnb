<?php

use App\Models\Bookable;
use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('bookables','Api\BookableController')->only(['index','show']);

Route::get('bookable/{id}/availability','Api\BookableAvailabilityController')->name('bookable.availability');
Route::get('bookable/{id}/review','Api\BookableReviewController')->name('bookable.review.index');
Route::get('bookable/{id}/price','Api\BookablePriceController')->name('bookable.price.show');

Route::apiResource('reviews','Api\ReviewController')->only(['show','store']);

Route::get('booking-by-review/{reviewKey}','Api\BookingByReviewController')->name('booking.by.review');

Route::post('checkout','Api\CheckoutController')->name('checkout');
