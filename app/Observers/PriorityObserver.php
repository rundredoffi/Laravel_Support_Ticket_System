<?php

namespace App\Observers;

use App\Models\Priority;
use Illuminate\Support\Facades\Cache;

class PriorityObserver
{
    /**
     * Handle the Priority "created" event.
     *
     * @param  \App\Models\Priority  $priority
     * @return void
     */
    public function created(Priority $priority)
    {
        // Clear priorities cache
        Cache::forget('priorities');
    }

    /**
     * Handle the Priority "updated" event.
     *
     * @param  \App\Models\Priority  $priority
     * @return void
     */
    public function updated(Priority $priority)
    {
        // Clear priorities cache
        Cache::forget('priorities');
    }

    /**
     * Handle the Priority "deleted" event.
     *
     * @param  \App\Models\Priority  $priority
     * @return void
     */
    public function deleted(Priority $priority)
    {
        // Clear priorities cache
        Cache::forget('priorities');
    }
}
