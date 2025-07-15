<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'company_name',
        'company_logo',
        'role',
        'is_frozen',
        'last_seen',
        'api_authorized',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_frozen' => 'boolean',
            'last_seen' => 'datetime',
            'api_authorized' => 'boolean',
        ];
    }

    /**
     * Check if user has a specific role
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is manager
     */
    public function isManager(): bool
    {
        return $this->role === 'manager';
    }

    /**
     * Check if user is regular user
     */
    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    /**
     * Check if user has admin or manager privileges
     */
    public function hasAdminAccess(): bool
    {
        return in_array($this->role, ['admin', 'manager']);
    }

    /**
     * Check if user is frozen
     */
    public function isFrozen(): bool
    {
        return $this->is_frozen;
    }

    /**
     * Check if user is online
     */
    public function isOnline(): bool
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    /**
     * Get user's online status
     */
    public function getOnlineStatusAttribute(): string
    {
        return $this->isOnline() ? 'Online' : 'Offline';
    }

    /**
     * Get formatted last seen time
     */
    public function getLastSeenFormatted(): string
    {
        if ($this->isOnline()) {
            return 'Online now';
        }

        if ($this->last_seen) {
            return $this->last_seen->diffForHumans();
        }

        return 'Never';
    }

    /**
     * Update user's last seen timestamp
     */
    public function updateLastSeen(): void
    {
        $this->update(['last_seen' => now()]);
    }

    /**
     * Set user as online
     */
    public function setOnline(): void
    {
        Cache::put('user-is-online-' . $this->id, true, now()->addMinutes(5));
        $this->updateLastSeen();
    }

    /**
     * Set user as offline
     */
    public function setOffline(): void
    {
        Cache::forget('user-is-online-' . $this->id);
        $this->updateLastSeen();
    }

    /**
     * Check if user is authorized for API access
     */
    public function isApiAuthorized(): bool
    {
        return $this->api_authorized;
    }
}
