<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


use App\Repositories\Interfaces\IEvent;
use App\Repositories\EventRepository;
use App\Repositories\Interfaces\IParticipant;
use App\Repositories\ParticipantRepository;
use App\Repositories\Interfaces\IRole;
use App\Repositories\RoleRepository;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(IEvent::class, EventRepository::class);
        $this->app->bind(IParticipant::class, ParticipantRepository::class);
        $this->app->bind(IRole::class, RoleRepository::class);
        $this->app->bind(IUser::class, UserRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
