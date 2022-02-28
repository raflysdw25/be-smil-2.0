<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="LokasiPenyimpananListDefaultResource",
     *      description="Lokasi Penyimpanan Resource",
     *      @OA\Xml(
     *          name="LokasiPenyimpananListDefaultResource"
     *      ),
     * )
     * 
     */

    class LokasiPenyimpananListDefaultResource{
        /**
         * @OA\Property(
         *      title="Response",
         *      description="Response Lokasi Penyimpanan Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Response
         * 
         */
        private $response;
        /**
         * @OA\Property(
         *      title="Data",
         *      description="Data Lokasi Penyimpanan Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\LokasiPenyimpanan[]
         * 
         */
        private $data;
        
    }
?>