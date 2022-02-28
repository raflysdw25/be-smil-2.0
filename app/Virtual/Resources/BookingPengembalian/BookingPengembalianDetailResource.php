<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="BookingPengembalianDetailResource",
     *      description="Booking Pengembalian Resource",
     *      @OA\Xml(
     *          name="BookingPengembalianDetailResource"
     *      ),
     * )
     * 
     */

    class BookingPengembalianDetailResource{
        /**
         * @OA\Property(
         *      title="Response",
         *      description="Response Booking Pengembalian Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Response
         * 
         */
        private $response;
        /**
         * @OA\Property(
         *      title="Data",
         *      description="Data Booking Pengembalian Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\BookingPengembalian
         * 
         */
        private $data;
        
    }
?>