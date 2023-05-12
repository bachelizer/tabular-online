<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Interfaces\IReport;
use App\Repositories\ReportRepository;
use App\Repositories\Interfaces\IEvent;
use App\Repositories\EventRepository;
use App\Repositories\Interfaces\IParticipant;
use App\Repositories\ParticipantRepository;
use App\Repositories\Interfaces\IRole;
use App\Repositories\RoleRepository;
use App\Repositories\Interfaces\IUser;
use App\Repositories\UserRepository;
use App\Repositories\Interfaces\ICriteria;
use App\Repositories\CriteriaRepository;
use App\Repositories\Interfaces\IScore;
use App\Repositories\ScoreRepository;
use App\Repositories\Interfaces\IAuth;
use App\Repositories\AuthRepository;
use App\Repositories\Interfaces\ISubEvent;
use App\Repositories\SubEventRepository;
use App\Repositories\Interfaces\ISubEventCriteria;
use App\Repositories\SubEventCriteriaRepository;
use App\Repositories\Interfaces\ISubScore;
use App\Repositories\SubEventScoreRepository;

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
        $this->app->bind(ISubScore::class, SubEventScoreRepository::class);
        $this->app->bind(ISubEvent::class, SubEventRepository::class);
        $this->app->bind(IReport::class, ReportRepository::class);
        $this->app->bind(IEvent::class, EventRepository::class);
        $this->app->bind(IParticipant::class, ParticipantRepository::class);
        $this->app->bind(IRole::class, RoleRepository::class);
        $this->app->bind(IUser::class, UserRepository::class);
        $this->app->bind(ICriteria::class, CriteriaRepository::class);
        $this->app->bind(IScore::class, ScoreRepository::class);
        $this->app->bind(IAuth::class, AuthRepository::class);
        $this->app->bind(ISubEventCriteria::class, SubEventCriteriaRepository::class);
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
