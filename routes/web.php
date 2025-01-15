<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// ====Auth===============
Auth::routes([
    'register' => false, // Disable registration
    'verify' => false,   // Disable email verification
]);
// ========End of Auth=======


// ========Frontend==============
require __DIR__ . '/public.php';
// =======end of Frontend=========

// ===========Backend============
Route::middleware(['auth.admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        require __DIR__ . '/admin.php';
    });
});
// =======end of Backend====

// =====handle wrong url======
Route::redirect('/{any}', '/', 301);
//=======end of handling wrong url===





