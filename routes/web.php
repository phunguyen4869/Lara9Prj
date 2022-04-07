<?php

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\MainCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SearchController;
use App\Http\Controllers\Admin\Users\UserController;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\Users\RegisterController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Admin\Users\SocialAuthController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

//prefix url admin
Route::prefix('admin')->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('login', 'index')->name('login');
        Route::post('login/store', 'store');
    });

    //route to register page
    Route::get(
        'register',
        [RegisterController::class, 'index']
    )->name('register');

    //post data to store function in RegisterController
    Route::post(
        'register/store',
        [RegisterController::class, 'store']
    );

    Route::get(
        '/auth/{provider}',
        [SocialAuthController::class, 'redirectToProvider']
    );
    Route::get(
        '/auth/{provider}/callback',
        [SocialAuthController::class, 'handleProviderCallback']
    );

    //route to verify email notice
    Route::get('/email/verify', function () {
        return view('admin.users.verify-email', [
            'title' => 'Verify Email',
        ]);
    })->middleware('auth')->name('verification.notice');

    //route to verify email
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('/admin')->with('status', 'Your e-mail is verified!');
    })->middleware(['auth', 'signed'])->name('verification.verify');

    //route to resend email verification
    Route::post('email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');

    Route::get('forgot-password', function () {
        return view(
            'admin.users.forgot-password',
            [
                'title' => 'Forgot Password',
            ]
        );
    })->middleware('guest')->name('password.request');

    Route::post('forgot-password', function (Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    })->middleware('guest')->name('password.email');

    Route::get('reset-password/{token}', function ($token) {
        return view(
            'admin.users.reset-password',
            ['title' => 'Reset Password', 'token' => $token]
        );
    })->middleware('guest')->name('password.reset');

    Route::post('reset-password', function (Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    })->middleware('guest')->name('password.update');

    //middleware group
    Route::middleware(['auth', 'verified'])->group(function () {
        route::controller(DashboardController::class)->group(function () {
            Route::get('/', 'index')->name('dashboard');
            Route::get('setting', 'setting');
            Route::post('setting', 'settingStore');
        });


        //route to manage user page
        Route::prefix('user')->group(function () {
            Route::controller(UserController::class)->group(function () {
                Route::middleware('role:admin')->group(function () {
                    Route::prefix('roles')->group(function () {
                        Route::get('list', 'rolesList');

                        Route::get('add', 'roleCreate');

                        Route::post('add', 'roleStore');

                        Route::get('edit/{id}', 'roleEdit');

                        Route::post('edit/{id}', 'roleUpdate');

                        Route::delete('destroy', 'roleDestroy');
                    });
                });

                Route::middleware('permission:show user')->group(function () {
                    //get route to user page
                    Route::get('list', 'index');
                });

                Route::middleware('permission:create user')->group(function () {
                    Route::get('add', 'create');

                    Route::post('add', 'store');
                });

                Route::middleware('permission:edit user')->group(function () {
                    //get route to edit user page
                    Route::get('edit/{user}', 'edit');

                    //post data to update function in UserController
                    Route::post('edit/{user}', 'update');
                });

                Route::middleware('permission:delete user')->group(function () {
                    //get route to delete user page
                    Route::delete('destroy', 'destroy');
                });

                Route::prefix('payment')->group(function () {
                    Route::middleware('permission:edit payment')->group(function () {
                        Route::get('list', 'paymentList');

                        Route::get('edit/{user}', 'paymentEdit');

                        Route::post('edit/{user}', 'paymentUpdate');
                    });

                    Route::middleware('permission:delete payment')->group(function () {
                        Route::delete('destroy', 'paymentDestroy');
                    });
                });
            });
        });

        //category routes
        Route::prefix('categories')->group(function () {
            Route::controller(CategoryController::class)->group(function () {
                Route::middleware('permission:show category')->group(function () {
                    //route to show category list
                    Route::get('list', 'index')->name('categories.index');
                });

                Route::middleware('permission:create category')->group(function () {
                    //route to create category
                    Route::get('create', 'create');

                    //route to store category
                    Route::post('store', 'store');
                });

                Route::middleware('permission:edit category')->group(function () {
                    //edit route to edit category page
                    Route::get('edit/{category}', 'edit');

                    //route to update category
                    Route::post('edit/{category}', 'update');
                });

                Route::middleware('permission:delete category')->group(function () {
                    //delete route to delete category page
                    Route::delete('destroy', 'destroy');
                });

                Route::middleware('role:admin|moderator')->group(function () {
                    //route to change category status
                    Route::get('changeStatus', 'changeStatus');
                });
            });
        });

        //product routes
        Route::prefix('products')->group(function () {
            Route::controller(ProductController::class)->group(function () {
                Route::middleware('permission:show product')->group(function () {
                    //route to show product list
                    Route::get('list', 'index');
                });

                Route::middleware('permission:create product')->group(function () {
                    //route to create product
                    Route::get('add', 'create');

                    //route to store product
                    Route::post('add', 'store');
                });

                Route::middleware('permission:edit product')->group(function () {
                    //route to edit product
                    Route::get('edit/{product}', 'show');

                    //route to update product
                    Route::post('edit/{product}', 'update');
                });

                Route::middleware('role:admin|moderator')->group(function () {
                    //route to change product status
                    Route::get('changeStatus', 'changeStatus');
                });

                Route::middleware('permission:delete product')->group(function () {
                    //route to delete product
                    Route::delete('destroy', 'destroy');
                });
            });
        });

        //slider routes
        Route::prefix('sliders')->group(function () {
            Route::controller(SliderController::class)->group(function () {
                Route::middleware('permission:show slider')->group(function () {
                    //route to show slider list
                    Route::get('list', 'index')->name('sliders.index');
                });

                Route::middleware('permission:create slider')->group(function () {
                    //route to create slider
                    Route::get('add', 'create');

                    //route to store new slider
                    Route::post('add', 'store');
                });

                Route::middleware('permission:edit slider')->group(function () {
                    //route to edit slider
                    Route::get('edit/{slider}', 'show');

                    //route to update slider
                    Route::post('edit/{slider}', 'update');
                });

                Route::middleware('permission:delete slider')->group(function () {
                    //route to delete slider
                    Route::delete('destroy', 'destroy');
                });

                Route::middleware('role:admin|moderator')->group(function () {
                    //route to change slider status
                    Route::get('changeStatus', 'changeStatus');
                });
            });
        });

        //route to upload
        Route::post('upload/services', [UploadController::class, 'store']);
    });

    //route to show order page
    Route::prefix('order')->group(function () {
        Route::controller(OrderController::class)->group(function () {
            Route::middleware('permission:show order')->group(function () {
                Route::get('list', 'index');
            });

            Route::middleware('permission:edit order')->group(function () {
                Route::get('edit/{order}', 'edit');

                Route::post('edit/{order}', 'update');
            });

            Route::middleware('permission:delete order')->group(function () {
                Route::delete('destroy', 'destroy');
            });

            Route::middleware('role:admin|moderator')->group(function () {
                //route to change order status
                Route::get('send-mail', 'sendMail');
            });

            Route::middleware('permission:orders export')->group(function () {
                Route::get('export', 'export');
            });
        });
    });

    Route::controller(SearchController::class)->group(function () {
        Route::get('search', 'index')->name('search');
    });
});

//Main page
Route::controller(MainController::class)->group(function () {
    Route::get('/', 'index')->name('home');

    //show product modal
    Route::get('productModal', 'showProductModal');

    //load more products
    Route::get('loadmore', 'loadMore');

    //product detail page
    Route::get('product/{id}-{slug}', 'showProductDetail');
});

//category page
Route::get('category/{id}-{slug}', [MainCategoryController::class, 'index']);

Route::controller(CartController::class)->group(function () {
    //add product to cart
    Route::post('addToCart', 'addToCart');

    //change product quantity
    Route::get('updateCart', 'updateCart');

    //remove product from cart
    Route::get('removeProduct', 'removeProduct');

    //show cart
    Route::get('cart', 'showCart');

    //check out
    Route::get('checkout', 'checkOut');

    Route::post('checkout', 'sendOrder');
});

//logout route
Route::get(
    'logout',
    [LoginController::class, 'logout']
)->name('logout');
