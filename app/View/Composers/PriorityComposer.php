<?php

namespace App\View\Composers;

use App\Models\Priority;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class PriorityComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $priorities = Cache::remember('priorities', 60*60*24*30, function() {
            return Priority::select(['id', 'name'])
                ->orderBy('name', 'ASC')
                ->get();
        });

        $view->with('priorities', $priorities);
    }
}