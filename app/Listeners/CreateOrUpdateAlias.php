<?php

namespace App\Listeners;

use App\Events\InsertNewRecord;
use App\Services\AliasService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Str;

class CreateOrUpdateAlias
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  InserNewRecord  $event
     * @return void
     */
    public function handle(InsertNewRecord $event)
    {
        $primaryKey = $event->object->getKeyName();
        app(AliasService::class)->createOrUpdateAlias(
            [
                'model_id' => $event->object->{$primaryKey},
                'model_type' => get_class($event->object)
            ],
            [
                'alias' => Str::slug($event->name, config('common.alias_separator', '-')),
            ]
        );
    }
}
