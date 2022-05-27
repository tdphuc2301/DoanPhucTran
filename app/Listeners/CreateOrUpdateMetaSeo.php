<?php

namespace App\Listeners;

use App\Events\ChangeMetaSeo;
use App\Services\MetaSeoService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreateOrUpdateMetaSeo
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
     * @param  ChangeMetaSeo  $event
     * @return void
     */
    public function handle(ChangeMetaSeo $event)
    {
        $primaryKey = $event->object->getKeyName();
        $metaseo = is_array($event->data) ? $event->data : (array)json_decode($event->data);
        app(MetaSeoService::class)->createOrUpdateMetaSeo(
            [
                'model_id' => $event->object->{$primaryKey},
                'model_type' => get_class($event->object)
            ],
            [
                'title' => $metaseo['title'] ?? null,
                'description' => $metaseo['description'] ?? null,
                'keyword' => $metaseo['keyword'] ?? null,
            ]
        );
    }
}
