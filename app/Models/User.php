<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Value in database for Administrator role.
     *
     * @var int
     */
    public const ADMINISTRATOR = 1;

    /**
     * Value in database for Agent role.
     *
     * @var int
     */
    public const AGENT = 2;

    /**
     * Value in database for regular user role.
     *
     * @var int
     */
    public const REGULAR_USER = 3;

    /**
     * Available user roles.
     *
     * @return array
     */
    public static function roles()
    {
        return [
            self::ADMINISTRATOR,
            self::AGENT,
            self::REGULAR_USER,
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Send email verification notification to the user.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new \App\Notifications\EmailVerificationNotification());
    }

    /**
     * Send reset password notification to the user.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \App\Notifications\ResetPasswordNotification($token));
    }

    /**
     * Get the tickets that belong to the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    /**
     * Get the tickets that are assigned to the user (agent).
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assignedTickets()
    {
        return $this->hasMany(Ticket::class, 'agent_id');
    }

    /**
     * Get the comments that belong to the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(TicketComment::class);
    }

    /**
     * Get the full name of the user.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Scope a query to get users tickets can be assigned to.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAssignableToTickets(Builder $query)
    {
        return $query->whereIn('role', [self::AGENT, self::ADMINISTRATOR]);
    }

    /**
     * Scope a query to get administrators.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAdministrators(Builder $query)
    {
        return $query->where('role', self::ADMINISTRATOR);
    }

    /**
     * Check if the user is administrator.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === self::ADMINISTRATOR;
    }

    /**
     * Check if the user can deal with tickets.
     *
     * @return bool
     */
    public function canDealWithTickets()
    {
        return $this->role === self::ADMINISTRATOR || $this->role === self::AGENT;
    }
}
