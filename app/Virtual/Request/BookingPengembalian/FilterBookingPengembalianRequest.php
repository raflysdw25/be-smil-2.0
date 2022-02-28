<?php

namespace App\Virtual\Request;
/**
 * @OA\Schema(
 *      title="Filter Booking Pengembalian request",
 *      description="Filter Booking Pengembalian request body data",
 *      type="object",
 * )
 */

class FilterBookingPengembalianRequest
{
    /**
     * @OA\Property(
     *      title="page_size",
     *      description="Page Size of Filter",
     *      example=5
     * )
     *
     * @var integer
     */
    public $page_size;

    /**
     * @OA\Property(
     *      title="sort_by",
     *      description="Sort Filter By Attributes",
     *      example="id"
     * )
     *
     * @var string
     */
    public $sort_by;
    
    /**
     * @OA\Property(
     *      title="sort_direction",
     *      description="Sort Direction of Filter",
     *      example="ASC"
     * )
     *
     * @var string
     */
    public $sort_direction;

    /**
     * @OA\Property(
     *      title="appointment_date",
     *      description="Filter Appointment date",
     *      format="datetime",
     *      type="string"
     * )
     *     
     * @var \DateTime
     */
    public $appointment_date;
    
    /**
     * @OA\Property(
     *      title="nomor_induk",
     *      description="Filter Nomor Induk",
     * )
     *
     * @var string
     */
    public $nomor_induk;
    
    /**
     * @OA\Property(
     *      title="booking_notes",
     *      description="Filter Booking Notes",
     * )
     *
     * @var string
     */
    public $booking_notes;

    /**
     * @OA\Property(
     *      title="is_booking_cancel",
     *      description="Filter Alat Year",
     * )
     *
     * @var Boolean
     */
    public $is_booking_cancel;

     /**
     * @OA\Property(
     *      title="process_by",
     *      description="Filter Process By",
     * )
     *
     * @var string
     */
    public $process_by;

    
}