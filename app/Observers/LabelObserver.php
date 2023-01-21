<?php

namespace App\Observers;

use App\Models\Label;
use Illuminate\Support\Facades\Cache;

class LabelObserver
{
    /**
     * Handle the Label "created" event.
     *
     * @param  \App\Models\Label  $label
     * @return void
     */
    public function created(Label $label)
    {
        // Clear labels cache
        Cache::forget('labels');
    }

    /**
     * Handle the Label "updated" event.
     *
     * @param  \App\Models\Label  $label
     * @return void
     */
    public function updated(Label $label)
    {
        // Clear labels cache
        Cache::forget('labels');
    }

    /**
     * Handle the Label "deleted" event.
     *
     * @param  \App\Models\Label  $label
     * @return void
     */
    public function deleted(Label $label)
    {
        // Clear labels cache
        Cache::forget('labels');
    }
}
