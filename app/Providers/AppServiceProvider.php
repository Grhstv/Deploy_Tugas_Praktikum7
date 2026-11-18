<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // [Modul 6] Hanya admin dan petugas yang boleh mengelola buku
        Gate::define('kelola-buku', function (User $user) {
            return $user->hasAnyRole(['admin', 'petugas']);
        });

        // [Modul 7] Di production (Vercel) seluruh URL dipaksa memakai https
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
