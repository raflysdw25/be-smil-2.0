<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = [
        'nip', 
        'nim',
        'email',      
        'password',
        'start_active_period',
        'end_active_period',
        'first_login',
        'jabatan_id',
        'is_verified',
        'image_data',
        'user_roles' //0: Super Admin, 1: Admin, 2: Peminjam
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Join
    public function staff_user(){
        return $this->belongsTo(Staff::class, 'nip', 'nip');
    }

    public function mahasiswa_user(){
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }
    public function jabatan_user(){
        return $this->belongsTo(Jabatan::class, 'jabatan_id', 'id');
    }

    // JWT Identifier
    public function getJWTIdentifier(){
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims(){
        return [];
    }
}
