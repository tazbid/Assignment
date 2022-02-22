<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Shetabit\Visitor\Traits\Visitor;
use App\Models\UserLogModel;
use App\Models\UserDetailsModel;
use App\Traits\UserTrait;

class User extends Authenticatable implements HasMedia
{
    use HasFactory, SoftDeletes, Notifiable, HasRoles, Visitor, InteractsWithMedia, UserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
    ];

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
    ];
    /**
     * defaining media/file collection
     *
     * @return void
     */
    public function registerMediaCollections(): void
    {
        //photos
        $this->addMediaCollection($this->userProfileImageCollection)->singleFile();
    }
}
