<?php

namespace App\Providers;

use Carbon\Carbon;
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
    setlocale(LC_TIME, 'id_ID.utf8');  // Pastikan lokalisasi ini tersedia di server Anda
    Carbon::setLocale('id');  // Set Carbon's locale to Indonesian
  }
}