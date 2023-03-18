<?php

use App\Models\User;

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\LoginController;
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

Route::middleware('auth')->group(function () {



    Route::get('/', function () {
        return Inertia::render(
            'Homepage'
        );
    });

    Route::get('/users', function () {

        return Inertia::render(
            'Users/Index',
            [
                'users' => User::when(request('search'), function ($query, $search) {
                    $query->where('name', 'like', "%{$search}%");
                })
                    ->orderBy('name', 'asc')
                    ->paginate(10)
                    ->withQueryString()
                    ->through(fn ($user) => [
                        'id' => $user->id,
                        'name' => $user->name
                    ]),
                'filters' => request(['search']),
                'can' => [
                    'createUser' => auth()->user()->can('create', User::class)
                ]

            ]
        );
    });

    Route::get('/settings', fn () => Inertia::render('Settings'));

    Route::post('logout', [LoginController::class, 'destroy']);


    Route::get('/users/create', function () {
        return Inertia::render('Users/Create');
    })->middleware('can:create, App\Models\User');

    Route::post('/users', function () {


        $attributes = request()->validate([
            'name' => ['required'],
            'email' => ['email', 'required', 'unique:users,email'],
            'password' => ['required']
        ]);

        User::create($attributes);

        return redirect('/users');
    });



    /*  */
});
Route::get('login', [LoginController::class, 'create'])->name('login');
Route::post('login', [LoginController::class, 'store']);
