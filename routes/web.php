<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
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


route::get("/register", [CustomerController::class, "index"]);
route::post("/register", [CustomerController::class, "register"])->name("customer.register");

route::get("/login", [CustomerController::class, "loginForm"])->name("login");
route::post("/login", [CustomerController::class, "userLogin"])->name("login.post");
route::get("/login/admin", [CustomerController::class, "adminLogin"])->name("admin.login");


Route::get("/dashboard", [CustomerController::class, "dashboard"])->name("user.dashboard")->middleware("auth");

Route::get("/dashboard/admin", [CustomerController::class, "admindashboard"])->name("admin.dashboard")->middleware("auth");

Route::resource("product", ProductController::class)->middleware("auth");

Route::post("/logout", [CustomerController::class, "logout"])->name("logout");

Route::post("/order", [ProductController::class, "order"])->name("create.order");

Route::get("/order-list", [ProductController::class, "orderTable"])->name("show.orders")->middleware("auth");
Route::get("/order-details", [ProductController::class, "orderDetails"])->name("order.details")->middleware("auth");


