<?php

use App\Http\Controllers\Admin\AcademicAreaController as AdminAcademicAreaController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CareerController as AdminCareerController;
use App\Http\Controllers\Admin\CurriculumController as AdminCurriculumController;
use App\Http\Controllers\Admin\InstitutionController as AdminInstitutionController;
use App\Http\Controllers\Admin\QuestionController as AdminQuestionController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Public\CareerController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\InstitutionController;
use App\Http\Controllers\Public\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\AcademicRouteController;
use App\Http\Controllers\Student\CompareController;
use App\Http\Controllers\Student\CostSimulatorController;
use App\Http\Controllers\Student\DashboardController;
use App\Http\Controllers\Student\FavoriteController;
use App\Http\Controllers\Student\InterestProfileController;
use App\Http\Controllers\Student\QuestionnaireController;
use Illuminate\Support\Facades\Route;

// --- Público ---
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/carreras', [CareerController::class, 'index'])->name('careers.index');
Route::get('/carreras/{career:slug}', [CareerController::class, 'show'])->name('careers.show');
Route::get('/instituciones', [InstitutionController::class, 'index'])->name('institutions.index');
Route::get('/instituciones/{institution:slug}', [InstitutionController::class, 'show'])->name('institutions.show');
Route::get('/buscar', [SearchController::class, 'index'])->name('search.index');
Route::get('/comparador', [CompareController::class, 'index'])->name('compare.index');

// --- Estudiante (autenticado) ---
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/cuestionario', [QuestionnaireController::class, 'show'])->name('questionnaire.show');
    Route::post('/cuestionario', [QuestionnaireController::class, 'store'])->name('questionnaire.store');

    Route::get('/perfil-intereses', [InterestProfileController::class, 'show'])->name('interest-profile.show');

    Route::post('/favoritos/carreras/{career}', [FavoriteController::class, 'toggleCareer'])->name('favorites.careers.toggle');
    Route::post('/favoritos/instituciones/{institution}', [FavoriteController::class, 'toggleInstitution'])->name('favorites.institutions.toggle');

    Route::get('/mi-ruta', [AcademicRouteController::class, 'show'])->name('my-route.show');
    Route::put('/mi-ruta', [AcademicRouteController::class, 'update'])->name('my-route.update');
    Route::post('/mi-ruta/items', [AcademicRouteController::class, 'addItem'])->name('my-route.items.add');
    Route::delete('/mi-ruta/items/{item}', [AcademicRouteController::class, 'removeItem'])->name('my-route.items.remove');

    Route::get('/simulador-costos', [CostSimulatorController::class, 'show'])->name('cost-simulator.show');
    Route::post('/simulador-costos', [CostSimulatorController::class, 'calculate'])->name('cost-simulator.calculate');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- Administrador ---
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('areas', AdminAcademicAreaController::class)->except(['show']);
    Route::resource('careers', AdminCareerController::class)->except(['show']);
    Route::resource('institutions', AdminInstitutionController::class)->except(['show']);
    Route::post('institutions/{institution}/careers', [AdminInstitutionController::class, 'addCareer'])->name('institutions.careers.add');
    Route::delete('institutions/{institution}/careers/{career}', [AdminInstitutionController::class, 'removeCareer'])->name('institutions.careers.remove');

    Route::get('institutions/{institution}/curriculum/{institutionCareer}', [AdminCurriculumController::class, 'edit'])->name('institutions.curriculum.edit');
    Route::put('institutions/{institution}/curriculum/{institutionCareer}', [AdminCurriculumController::class, 'updateName'])->name('institutions.curriculum.update-name');
    Route::post('institutions/{institution}/curriculum/{institutionCareer}/items', [AdminCurriculumController::class, 'storeItem'])->name('institutions.curriculum.items.store');
    Route::delete('institutions/{institution}/curriculum/{institutionCareer}/items/{item}', [AdminCurriculumController::class, 'destroyItem'])->name('institutions.curriculum.items.destroy');

    Route::resource('questions', AdminQuestionController::class)->except(['show']);
    Route::post('questions/{question}/options', [AdminQuestionController::class, 'addOption'])->name('questions.options.add');
    Route::delete('questions/{question}/options/{option}', [AdminQuestionController::class, 'removeOption'])->name('questions.options.remove');

    Route::get('users', [AdminUserController::class, 'index'])->name('users.index');
    Route::patch('users/{user}/role', [AdminUserController::class, 'updateRole'])->name('users.role.update');
});

require __DIR__.'/auth.php';
