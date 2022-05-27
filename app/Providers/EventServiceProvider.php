<?php

namespace App\Providers;

use App\Events\ChangeMetaSeo;
use App\Events\InsertNewRecord;
use App\Listeners\CreateOrUpdateAlias;
use App\Listeners\CreateOrUpdateMetaSeo;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        InsertNewRecord::class => [
            CreateOrUpdateAlias::class
        ],
        ChangeMetaSeo::class => [
            CreateOrUpdateMetaSeo::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
