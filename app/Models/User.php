<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
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
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'dateStarted', 'leaveDays'
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
        'dateStarted' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'entitlement',
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

    /**
     * One User could have Many Holidays
     *
     * @return void
     */
    public function holidays()
    {
        return $this->hasMany('App\Models\Holiday');
    }

    /**
     * One User could have Many Messages
     *
     * @return void
     */
    public function messages()
    {
        return $this->hasMany('App\Models\Message');
    }

    /**
     * Creates a relationship so that
     * one User has one Work Day Pattern
     *
     * @return void
     */
    public function workday()
    {
        return $this->hasOne('App\Models\WorkingDay');
    }

    /**
     * This Creates a Has many relationship to the Role Model
     *
     * @return void
     */
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    /**
     * Makes the Search function work in the blade files
     *
     * @param  mixed $search
     * @return void
     */
    public static function search($search)
    {
        return empty($search) ? static::query()
            : static::query()->where('description', 'like', '%' . $search . '%')
            ->orWhere('bankdate', 'like', '%' . $search . '%');
    }


    /**
     * Check if the user has a role
     *
     * @param  string $role
     * @return void
     */
    public function hasAnyRole(string $role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }

    /**
     * Check the Users has any given roles
     *
     * @param  array $role
     * @return void
     */
    public function hasAnyRoles(array $role)
    {
        return null !== $this->roles()->whereIn('name', $role)->get();
    }


    public function getDateStartedAttribute($value)
    {
        return Carbon::parse($value)->toFormattedDateString();
    }
}
