<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVerify extends Model
{
    use HasFactory;
    protected $table = 'user_verify';
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nim_mahasiswa',
        'nip_staff',
        'user_id',
        'token',
    ];


    // Relasi
    public function mahasiswa_verified(){
        return $this->belongsTo(Mahasiswa::class,'nim_mahasiswa', 'nim');
    }
    public function staff_verified(){
        return $this->belongsTo(Staff::class,'nip_staff', 'nip');
    }
    public function user_verified(){
        return $this->belongsTo(User::class,'user_id', 'id');
    }
}
