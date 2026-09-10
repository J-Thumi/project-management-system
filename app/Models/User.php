<?php

namespace App\Models;

use App\Traits\HasUuid;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    use HasUuid, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * Map Laravel's default password getter to your custom column name.
     */
    public function getAuthPassword(): string
    {
        return $this->password;
    }

    /**
     * Filament v3 authorization check.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public function clientProjects(): HasMany
    {
        return $this->hasMany(Project::class, 'client_id');
    }

    public function designerProjects(): HasMany
    {
        return $this->hasMany(Project::class, 'designer_id');
    }

    public function supervisorProjects(): HasMany
    {
        return $this->hasMany(Project::class, 'supervisor_id');
    }
}