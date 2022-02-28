<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="BookingPengembalianListResource",
     *      description="Booking Pengembalian Resource",
     *      @OA\Xml(
     *          name="BookingPengembalianListResource"
     *      ),
     * )
     * 
     */

    class BookingPengembalianListResource{
        /**
         * @OA\Property(
         *      title="Result",
         *      description="Result Booking Pengembalian Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\BookingPengembalian[]
         * 
         */
        private $result;
        /**
         * @OA\Property(
         *      title="Page",
         *      description="Page Booking Pengembalian Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Page
         * 
         */
        private $page;
    }
?>