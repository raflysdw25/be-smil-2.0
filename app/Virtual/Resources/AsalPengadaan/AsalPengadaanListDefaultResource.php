<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="AsalPengadaanListDefaultResource",
     *      description="Prodi Resource",
     *      @OA\Xml(
     *          name="AsalPengadaanListDefaultResource"
     *      ),
     * )
     * 
     */

    class AsalPengadaanListDefaultResource{
        /**
         * @OA\Property(
         *      title="Response",
         *      description="Response Asal Pengadaan Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Response
         * 
         */
        private $response;
        /**
         * @OA\Property(
         *      title="Data",
         *      description="Data Asal Pengadaan Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\AsalPengadaan
         * 
         */
        private $data;
        
    }
?>