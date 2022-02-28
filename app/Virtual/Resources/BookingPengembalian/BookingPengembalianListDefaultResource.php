<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="BookingPengembalianListDefaultResource",
     *      description="List Resource Resource",
     *      @OA\Xml(
     *          name="BookingPengembalianListDefaultResource"
     *      ),
     * )
     * 
     */

    class BookingPengembalianListDefaultResource{        
        /**
         * @OA\Property(
         *      title="Response",
         *      description="Response",
         * )
         * 
         * @var \App\Virtual\Models\Response
         * 
         */
        private $response;
        /**
         * @OA\Property(
         *      title="data",
         *      description="List Booking Pengembalian Default Wrapperr",
         * )
         * 
         * @var \App\Virtual\Models\BookingPengembalian[]
         * 
         */
        private $data;
    }
?>