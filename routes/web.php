<?php


use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuotationController;

use App\Http\Controllers\AwardController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ErrorReportController;
use App\Http\Controllers\PointRubricController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::resource('awards', AwardController::class)
->middleware('auth')
->except('show');
Route::get('/awards-history', [AwardController::class,'history'])->name('awards.history');
Route::post('/awards-trade', [AwardController::class,'trade'])->name('awards.trade');


Route::get('/chat', [ChatController::class,'index'])->name('chat.index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

Route::resource('orders', OrderController::class)->middleware(['auth']);

Route::get('/products', [ProductController::class, 'index'])
    ->middleware('auth')
    ->name('products.index');

Route::get('/quotations', [QuotationController::class, 'index'])
    ->middleware('auth')
    ->name('quotations.index');

Route::get('/points-rubric', [PointRubricController::class, 'index'])
    ->middleware('auth')
    ->name('pointsRubric.index');

    Route::resource('error-reports', ErrorReportController::class);
    Route::put('error-reports/mark-as-read/{error}', [ErrorReportController::class, 'markAsRead'])->name('error-reports.mark-as-read');