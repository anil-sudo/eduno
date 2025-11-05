<?php

namespace App\Observers;

// Models
use App\Models\Setting;

// Artisan
use Illuminate\Support\Facades\Artisan;

class SettingObserver
{
    /**
     * Handle the Setting "created" event.
     */
    public function created(Setting $setting): void
    {
        Artisan::call('cache:clear');
    }

    /**
     * Handle the Setting "updated" event.
     */
    public function updated(Setting $setting): void
    {
        Artisan::call('cache:clear');
    }

    /**
     * Handle the Setting "deleted" event.
     */
    public function deleted(Setting $setting): void
    {
        Artisan::call('cache:clear');
    }

    /**
     * Handle the Setting "restored" event.
     */
    public function restored(Setting $setting): void
    {
        Artisan::call('cache:clear');
    }

    /**
     * Handle the Setting "force deleted" event.
     */
    public function forceDeleted(Setting $setting): void
    {
        Artisan::call('cache:clear');
    }
}