<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate; // Add this line

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        \App\Models\Playlist::class => \App\Policies\PlaylistPolicy::class,
        
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update-playlist', [PlaylistPolicy::class, 'update']);
        // Add other gates if needed
    }
}
