<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Used for UUID generation
use Illuminate\Notifications\Notifiable; // Used for type hinting the scope

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasUuids, Notifiable;

    protected $connection = 'pgsql';
    // --- CRITICAL UUID CONFIGURATION FIXES ---

    /**
     * Indicates if the IDs are auto-incrementing.
     * Must be false when using UUIDs or non-integer primary keys.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The data type of the primary key.
     * Must be 'string' when using UUIDs.
     *
     * @var string
     */
    protected $keyType = 'string';

    // --- END UUID CONFIGURATION FIXES ---

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // --- Relationships ---

    public function store()
    {
        // FIX: Ensure 'Store' class is imported or fully qualified (assuming it's App\Models\Store)
        return $this->hasOne(\App\Models\Store::class);
    }

    public function buyer()
    {
        // FIX: Ensure 'Buyer' class is imported or fully qualified (assuming it's App\Models\Buyer)
        return $this->hasOne(\App\Models\Buyer::class);
    }

    // --- Local Scopes ---

    public function scopeSearch(Builder $query, string $search)
    {
        // Cleaned up syntax for readability
        return $query->where('name', 'like', '%'.$search.'%')
            ->orWhere('email', 'like', '%'.$search.'%');
    }
}
