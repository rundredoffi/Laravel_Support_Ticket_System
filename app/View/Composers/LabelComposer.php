<?php

namespace App\View\Composers;

use App\Models\Label;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class LabelComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $labels = Cache::remember('labels', 60*60*24*30, function() {
            return Label::select(['id', 'name'])
                ->orderBy('name', 'ASC')
                ->get();
        });

        $view->with('labels', $labels);
    }
}