<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogPeminjaman extends Model
{
    use HasFactory;

    protected $table = 'log_peminjaman';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'peminjaman_id',
        'action', //Data Peminjaman Dibuat (CREATED), Daftar Alat Dipinjam (REGISTER) , Persetujuan Peminjaman (ACCEPTED/REJECTED), Pengembalian Alat (RETURN),
        'created_by',
    ];

    // Relation
    public function related_peminjaman(){
        return $this->belongsTo(Peminjaman::class,'peminjaman_id', 'id');
    }
}
