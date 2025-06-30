<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));
        });
    }

    /**
     * Redirección personalizada después de verificar el email.
     */
    public static function redirectTo(): string
    {
        $user = Auth::user();

        if ($user && $user->isEmpresa() && $user->status === 'pendiente') {
            return '/empresa/esperando-aprobacion';
        }

        return '/dashboard';
    }
}

