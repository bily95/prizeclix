<?php

namespace App\Models;


use App\Models\Services\UserRelations;
use App\Models\Services\UserScopes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, UserRelations, UserScopes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    protected $fillable = [
        'token_id',
        'email',
        'google_id',
        'mobile',
        'username',
        'timezone',
        'password',
        'ref_by',
        'ev',
        'sv',
        'balance',
    ];

    protected $attributes = [
        'tv' => 1,
        'ts' => 0,
        'status' => 1,
    ];

    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'address' => 'object',
        'ver_code_send_at' => 'datetime'
    ];

    protected $data = [
        'data' => 1
    ];
}
