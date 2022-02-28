<?php 
    namespace App\Virtual\Models;

    /**
     * @OA\Schema(
     *      title="Booking Pengembalian",
     *      description="Booking Pengembalian Model",
     *      @OA\Xml(
     *          name="Booking Pengembalian" 
     *      )
     * 
     * )
     * 
     */

     class BookingPengembalian{
        /**
         * @OA\Property(
         *     title="ID",
         *     description="ID",
         *     format="int64",
         *     example=1
         * )
         *
         * @var integer
         */
        private $id;

        /**
         * @OA\Property(
         *      title="Appointment Date",
         *      description="Date of Appointment",
         *      example="2020-01-27 17:50:45",
         *      format="datetime",
         *      type="string"
         * )
         *
         * @var \DateTime
         */
        private $appointment_date;

        /**
         * @OA\Property(
         *     title="NIM Mahasiswa",
         *     description="Nomor Induk Mahasiswa",
         *     example="12344567890"
         * )
         *
         * @var string
         */
        private $nim_mahasiswa;

        /**
         * @OA\Property(
         *      title="Mahasiswa Model",
         *      description="Model of the Mahasiswa",
         * )
         *
         * @var \App\Virtual\Models\Mahasiswa
         */
        private $booking_by_mahasiswa;
        
        /**
         * @OA\Property(
         *     title="NIP Staff",
         *     description="Nomor Induk Pegawai",
         *     example="12344567890"
         * )
         *
         * @var string
         */
        private $nip_staff;

         /**
         * @OA\Property(
         *      title="Staff Model",
         *      description="Model of the Staff",
         * )
         *
         * @var \App\Virtual\Models\Staff
         */
        private $booking_by_staff;

        /**
         * @OA\Property(
         *     title="Peminjaman ID",
         *     description="Peminjaman ID",
         *     format="int64",
         *     example=1
         * )
         *
         * @var integer
         */
        private $peminjaman_id;

         /**
         * @OA\Property(
         *      title="Peminjaman Model",
         *      description="Model of the Peminjaman",
         * )
         *
         * @var \App\Virtual\Models\Peminjaman
         */
        private $peminjaman_need_pengembalian;
        
        /**
         * @OA\Property(
         *      title="Is Booking Cancel",
         *      description="Is Booking Cancel",
         *      example=true
         * )
         *
         * @var Boolean
         */
        private $is_booking_cancel;

        /**
         * @OA\Property(
         *     title="Booking Notes",
         *     description="Booking Notes",
         *     example=""
         * )
         *
         * @var string
         */
        private $booking_notes;
        
        /**
         * @OA\Property(
         *     title="Process By",
         *     description="Process By",
         *     example=""
         * )
         *
         * @var string
         */
        private $process_by;


        /**
         * @OA\Property(
         *      title="Created Date",
         *      description="Date of data been created",
         *      example="2020-01-27 17:50:45",
         *      format="datetime",
         *      type="string"
         * )
         *
         * @var \DateTime
         */
        private $created_at;


        /**
         * @OA\Property(
         *     title="Updated at",
         *     description="Updated at",
         *     example="2020-01-27 17:50:45",
         *     format="datetime",
         *     type="string"
         * )
         *
         * @var \DateTime
         */
        private $updated_at;
       
        /**
         * @OA\Property(
         *     title="Deleted at",
         *     description="Deleted at",
         *     example="2020-01-27 17:50:45",
         *     format="datetime",
         *     type="string"
         * )
         *
         * @var \DateTime
         */
        private $deleted_at;
     }


?>