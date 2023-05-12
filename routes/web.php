<?php

use Illuminate\Support\Facades\Route;

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

/**
 * Management(admin) routes hidden under /management/ 
 */
// Route::prefix(App::getLocale())->middleware('lang')->group(function () {
Route::prefix('management')->group(function () {
    
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::resources([
            'questionnaires' => \App\Http\Controllers\QuestionnaireController::class,
            'assemblies' => \App\Http\Controllers\AssemblyController::class,
            'questions' => \App\Http\Controllers\QuestionController::class,
            'answers' => \App\Http\Controllers\AnswerController::class,
            'applicants' => \App\Http\Controllers\ApplicantController::class,
            'statistics' => \App\Http\Controllers\StaticticsController::class,
            'settings' => \App\Http\Controllers\SettingController::class,
            'categories' => \App\Http\Controllers\CategoryController::class,
            'category-values' => \App\Http\Controllers\CategoryValueController::class,
        ]);
        Route::get('/', App\Http\Controllers\Dashboard::class);
        Route::get('/dashboard', App\Http\Controllers\Dashboard::class)->name('dashboard');
        Route::get('/locale/{locale}', [\App\Http\Controllers\LocalizationController::class, 'setLocale'])->name('locale');
        Route::get('/questionnaires', [\App\Http\Controllers\QuestionnaireController::class, 'indexAdmin'])->name('questionnaires.index');
        Route::get('/questionnaires_settings', [\App\Http\Controllers\QuestionnaireController::class, 'settings'])->name('questionnaires.settings');
        Route::get('/applicants', [\App\Http\Controllers\ApplicantController::class, 'indexAdmin'])->name('applicants.index');
        Route::get('/statistics', [\App\Http\Controllers\StaticticsController::class, 'indexAdmin'])->name('statistics.index');
        Route::get('/logs', [\App\Http\Controllers\QuestionnaireController::class, 'indexAdmin'])->name('logs.index');
        Route::get('/questionnaires_pages', [\App\Http\Controllers\QuestionnairePageController::class, 'indexAdmin'])->name('questionnaires_pages.index');
        Route::get('/validations', [\App\Http\Controllers\ValidationController::class, 'index'])->name('validations.index');
        Route::get('/settings', [\App\Http\Controllers\SettingController::class, 'index'])->name('settings.index');
    });
});


Route::get('/setLocale', [\App\Http\Controllers\LocalizationController::class, 'setLocale']);

Route::post('/last', [\App\Http\Controllers\QuestionnairePageController::class, 'saveLast']);
Route::get('/cancel', [\App\Http\Controllers\QuestionnairePageController::class, 'cancel']);
Route::get('/secret/registrations', [\App\Http\Controllers\QuestionnaireController::class, 'result']);

Route::get('/', [\App\Http\Controllers\QuestionnaireController::class, 'indexApplicant']);
Route::post('/', [\App\Http\Controllers\QuestionnaireController::class, 'signIn']);
Route::get('/{questionnairePath}', [\App\Http\Controllers\QuestionnaireController::class, 'indexApplicant']);
Route::post('/{questionnairePath}', [\App\Http\Controllers\QuestionnaireController::class, 'signIn']);
Route::get('/{questionnairePath}/last', [\App\Http\Controllers\QuestionnairePageController::class, 'saveLast']);
//Route::post('/{questionnairePath}/last', [\App\Http\Controllers\QuestionnairePageController::class, 'saveLast']);
Route::get('/{questionnairePath}/cancel', [\App\Http\Controllers\QuestionnairePageController::class, 'cancel']);
Route::get('/{questionnairePath}/{page}', [\App\Http\Controllers\QuestionnairePageController::class, 'page']);
Route::post('/{questionnairePath}/{page}', [\App\Http\Controllers\QuestionnairePageController::class, 'savePage']);

// });


Route::get("sitemap.xml" , function () {
    return \Illuminate\Support\Facades\Redirect::to('sitemap.xml');
});



// Route::get('/podwieczorek', [\App\Http\Controllers\QuestionnaireController::class, 'index2']);
// Route::post('/podwieczorek', [\App\Http\Controllers\QuestionnaireController::class, 'signIn2']);
// Route::get('/podwieczorek/nickname', [\App\Http\Controllers\QuestionnaireController::class, 'nickname']);
// Route::post('/podwieczorek/nickname', [\App\Http\Controllers\QuestionnaireController::class, 'nicknameSave']);
// Route::get('/podwieczorek/cancel', [\App\Http\Controllers\QuestionnairePageController::class, 'cancel2']);


//Route::get('/panel', function () {
//    return view('welcome');
//});
//Route::prefix('panel')->group(function () {
//    Route::get('/locale/{locale}', [App\Http\Controllers\LocalizationController::class, 'setLocale'])->name('locale');
//
//    Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//        return view('dashboard');
//    })->name('dashboard');
//
//    Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//        return view('dashboard');
//    })->name('dashboard');
//
//    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
//        Route::resources([
//            'assemblies' => App\Http\Controllers\AssemblyController::class,
//            'categories' => App\Http\Controllers\CategoryController::class,
//            'category-values' => App\Http\Controllers\CategoryValueController::class,
//        ]);
//    });
//});