<?php

namespace App\Virtual\Request;
/**
 * @OA\Schema(
 *      title="Store Booking Pengembalian Request",
 *      description="Store Booking Pengembalian Request body data",
 *      type="object",
 * )
 */

class StoreBookingPengembalianRequest
{
    /**
     * @OA\Property(
     *      title="booking_id",
     *      description="Booking ID",
     * )
     *
     * @var integer
     */
    public $booking_id;

    /**
     * @OA\Property(
     *      title="appointment_date",
     *      description="Appointment Date",
     *      example="2022-02-15",
     *      format="datetime",
     *      type="string"
     * )
     *
     * @var DateTime
     */
    public $appointment_date;
    
    /**
     * @OA\Property(
     *      title="nim_mahasiswa",
     *      description="NIM Mahasiswa",
     *      example="1234567890"
     * )
     *
     * @var string
     */
    public $nim_mahasiswa;
    
    /**
     * @OA\Property(
     *      title="nip_staff",
     *      description="NIP Staff",
     *      example="1234567890"
     * )
     *
     * @var string
     */
    public $nip_staff;

    /**
     * @OA\Property(
     *      title="peminjaman_id",
     *      description="Peminjaman ID",
     * )
     *
     * @var integer
     */
    public $peminjaman_id;

    /**
     * @OA\Property(
     *      title="is_booking_cancel",
     *      description="Is Booking Cancel",
     *      example=true
     * )
     *
     * @var Boolean
     */
    public $is_booking_cancel;

    /**
     * @OA\Property(
     *      title="booking_notes",
     *      description="Booking Notes",
     * )
     *
     * @var string
     */
    public $booking_notes; 
    
        /**
     * @OA\Property(
     *      title="is_submit_booking",
     *      description="Is Submit Booking",
     *      example=true
     * )
     *
     * @var Boolean
     */
    public $is_submit_booking;

    

    
}