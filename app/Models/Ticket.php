<?php

namespace App\Models;

use App\Traits\HasFilesTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class Ticket extends Model
{
    use HasFactory, HasFilesTrait, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'closed_at',
        'priority_id',
        'agent_id',
    ];

    /**
     * Name of the folder with the files.
     *
     * @var string
     */
    protected $folderWithFiles = 'tickets';

    /**
     * Get the user that belong the ticket belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user (agent) that the ticket is assigned to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function agent()
    {
        return $this->belongsTo(User::class)
            ->select(['id', 'first_name', 'last_name']);
    }

    /**
     * Get categories that belong to the ticket.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class)
            ->select(['id', 'name']);
    }

    /**
     * Get labels that belong to the ticket.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function labels()
    {
        return $this->belongsToMany(Label::class)
            ->select(['id', 'name']);
    }

    /**
     * Get the priority that belong to the ticket.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function priority()
    {
        return $this->belongsTo(Priority::class)
            ->select(['id', 'name']);
    }

    /**
     * Get comments that belong to the ticket.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(TicketComment::class)
            ->with('user:id,first_name,last_name,role')
            ->latest();
    }

    public function activities()
    {
        return $this->morphMany(Activity::class, 'subject')
            ->select(['id', 'created_at', 'description', 'subject_id'])
            ->latest();
    }

    /**
     * Options for the activity logs.
     *
     * @return \Spatie\Activitylog\LogOptions
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['title', 'description', 'priority_id', 'agent_id'])
            ->dontSubmitEmptyLogs()
            ->useLogName('ticket')
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn(string $eventName) => "The ticket has been {$eventName}");
    }

    /**
     * Scope a query to get only tickets accessible by authenticated user.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder|null
     */
    public function scopeAccessible(Builder $query)
    {
        switch (auth()->user()->role) {
            case User::AGENT:
                return $query->where('agent_id', auth()->id());
                break;
            case User::REGULAR_USER:
                return $query->where('user_id', auth()->id());
                break;
            default:
                return;
        }
    }

    /**
     * Scope a query to get only open tickets.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOpen(Builder $query)
    {
        return $query->whereNull('closed_at');
    }

    /**
     * Scope a query to get only closed tickets.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeClosed(Builder $query)
    {
        return $query->whereNotNull('closed_at');
    }

    /**
     * Check if the ticket is closed.
     *
     * @return bool
     */
    public function isClosed()
    {
        return $this->closed_at != null;
    }
}
