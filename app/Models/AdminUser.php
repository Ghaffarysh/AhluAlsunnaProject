<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Notifications\Notifiable;

class AdminUser extends Authenticatable {
    use HasUuids, SoftDeletes, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'permissions', 'is_active'
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'permissions'   => 'array',
        'is_active'     => 'boolean',
        'last_login_at' => 'datetime',
    ];

    public function isSuperAdmin(): bool   { return $this->role === 'super_admin'; }
    public function isGeneralAdmin(): bool { return $this->role === 'general_admin'; }
    public function isAdmin(): bool        { return $this->role === 'admin'; }

    public function hasPermission(string $permission): bool {
        if ($this->isSuperAdmin()) return true;
        return in_array($permission, $this->permissions ?? []);
    }

    public function tokens() {
        return $this->morphMany(\Laravel\Sanctum\PersonalAccessToken::class, 'tokenable');
    }

    public function createToken(string $name, array $abilities = ['*']) {
        $token = $this->tokens()->create([
            'name'      => $name,
            'token'     => hash('sha256', $plaintext = \Illuminate\Support\Str::random(40)),
            'abilities' => $abilities,
        ]);
        return new \Laravel\Sanctum\NewAccessToken($token, $token->getKey() . '|' . $plaintext);
    }
}