<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="CekPelaporResource",
     *      description="Cek Pelapor Resource",
     *      @OA\Xml(
     *          name="CekPelaporResource"
     *      ),
     * )
     * 
     */

    class CekPelaporResource{
        /**
         * @OA\Property(
         *      title="Response",
         *      description="Response Cek Pelapor Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Response
         * 
         */
        private $response;
        /**
         * @OA\Property(
         *      title="Data",
         *      description="Data Cek Pelapor Wrapper",
         *      example=null
         * )
         * 
         * @var \App\Virtual\Models\CekPelapor
         * 
         */
        private $data;
        
    }
?>