<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingPengembalianResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'appointment_date' => $this->appointment_date,
            'nim_mahasiswa' => $this->nim_mahasiswa,
            'booking_by_mahasiswa' => $this->booking_by_mahasiswa,
            'nip_staff' => $this->nip_staff,
            'booking_by_staff' => $this->booking_by_staff,
            'peminjaman_id' => $this->peminjaman_id,
            'peminjaman_need_pengembalian' => $this->peminjaman_need_pengembalian,
            'is_booking_cancel' => $this->is_booking_cancel,
            'booking_notes' => $this->booking_notes,
            'process_by' => $this->process_by,
            'created_at' => (string) $this->created_at,
            'updated_at' => (string) $this->updated_at,
            'deleted_at' => (string) $this->deleted_at,
        ];
    }
}
