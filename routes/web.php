<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;
use App\Models\Quiz;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/quiz/create', function () {
        return view('quizzes.create');
    });

    Route::get('/quiz/{quiz_id}/start', function ($quizId) {
        $quiz = Quiz::find($quizId);
        if($quiz == null) {
            return abort(404);
        }else {
            return view('quizzes.start', ["quiz" => $quiz]);
        }

    });
    
    Route::post('/quiz/create', [QuizController::class, 'store']);
    
});

// Static routes
Route::get('/static/js/{path}', function ($path) {
    $fullPath = resource_path('js/' . $path);
    if (!file_exists($fullPath)) {
        abort(404);
    }
    return response()->file($fullPath, ['Content-Type' => 'application/javascript']);
})->where('path', '.*');

Route::get('/static/css/{path}', function ($path) {
    $fullPath = resource_path('css/' . $path);
    if (!file_exists($fullPath)) {
        abort(404);
    }
    return response()->file($fullPath, ['Content-Type' => 'text/css']);
})->where('path', '.*');

require __DIR__.'/auth.php';
