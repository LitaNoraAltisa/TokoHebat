<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Admin routes
Route::middleware('auth:sanctum')->get('/admin/{id}', function (Request $request, $id) {

    // Hanya admin yang boleh akses
    if ($request->user()->role !== 'admin') {
        return response()->json([
            'message' => 'Forbidden - hanya admin'
        ], 403);
    }

    // Ambil data
    $user = User::find($id);

    // Jika data tidak ditemukan
    if (!$user) {
        return response()->json([
            'message' => 'Data tidak ditemukan'
        ], 404);
    }

    return response()->json($user);
});