<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Jika Anda ingin namespace otomatis (misal "App\Http\Controllers"),
     * uncomment baris berikut dan sesuaikan. Namun sejak Laravel 8, defaultnya null.
     */
    protected $namespace = null;

    /**
     * Biasanya metode ini di‐override untuk route model binding, dsb.
     */
    public function boot(): void
    {
        parent::boot();
    }

    /**
     * Daftarkan semua route untuk aplikasi.
     */
    public function map(): void
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();
    }

    /**
     * Daftarkan route‐route yang memakai middleware "web".
     */
    protected function mapWebRoutes(): void
    {
        Route::middleware('web')
             ->namespace($this->namespace)  // Jika $namespace = null, maka di rute harus menggunakan FQCN.
             ->group(base_path('routes/web.php'));
    }

    /**
     * Daftarkan route‐route API (prefix "api", middleware "api").
     */
    protected function mapApiRoutes(): void
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
