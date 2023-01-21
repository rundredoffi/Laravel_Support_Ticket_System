<?php

namespace App\Http\Controllers;

use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller
{
    /**
     * Display the page with activity logs.
     *
     * @return \Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function __invoke()
    {
        $this->authorize('access-activities');

        $activities = Activity::select(['id', 'created_at', 'log_name', 'causer_id', 'causer_type', 'description', 'subject_type', 'subject_id'])
            ->with('causer:id,first_name,last_name,role')
            ->latest()
            ->paginate(20);

        return view('web.activities.index', compact('activities'));
    }
}
