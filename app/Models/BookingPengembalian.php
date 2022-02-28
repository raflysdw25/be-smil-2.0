<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingPengembalian extends Model
{
    use HasFactory;

    protected $table = 'booking_pengembalian';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'appointment_date',
        'nim_mahasiswa',
        'nip_staff',
        'peminjaman_id',
        'is_booking_cancel', //Value: Null (Belum diproses), false (Booking Selesai), true (Booking Batal)
        'booking_notes',
        'process_by',
    ];

    // Relation
    public function peminjaman_need_pengembalian(){
        return $this->belongsTo(Peminjaman::class,'peminjaman_id', 'id');
    }
    public function booking_by_mahasiswa(){
        return $this->belongsTo(Mahasiswa::class,'nim_mahasiswa', 'nim');
    }
    public function booking_by_staff(){
        return $this->belongsTo(Staff::class,'nip_staff', 'nip');
    }
}
