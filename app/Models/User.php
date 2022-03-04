<?php

namespace App\Models;

use Illuminate\Support\Str;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'email', 'password','role','dateStarted'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        // 'dateStarted' => 'date:d-m-Y',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * The List of User Roles
     *
     * @return void
     */
    public static function userRoleList()
    {
        $roles = Role::all();
        $roleArray = [];
        foreach ($roles as $key => $role) {
            $roleArray[Str::lower($role->name)] = Str::ucfirst($role->name);
        }
        return $roleArray;
    }

    public function holidays()
    {
        return $this->hasMany('App\Models\Holiday');
    }

    public function messages()
    {
        return $this->hasMany('App\Models\Message');
    }

    public function workday()
    {
        return $this->hasOne('App\Models\WorkingDay');
    }

    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()->where('role', 'like', '%'.$search.'%')
                ->orWhere('name', 'like', '%'.$search.'%')
                ->orWhere('email', 'like', '%'.$search.'%');
    }
}
