<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Admin extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $fillable = ['id', 'name', 'username', 'role_id', 'status', 'email', 'password', 'created_at', 'updated_at'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed'

    ];

    public function posts()
    {
        return $this->hasMany(Post::class, 'admin_id');
    }
    public function authorization()
    {
        return $this->belongsTo(Authorization::class, 'role_id');
    }

    public function hasAccess($config_permissions)
    {
        $authorization = $this->authorization;

        if (!$authorization) {
            return false;
        }
        foreach ($authorization->permissions as $permission) {
            if ($config_permissions == $permission ?? false) {
                return true;
            }
        }
    }
}
