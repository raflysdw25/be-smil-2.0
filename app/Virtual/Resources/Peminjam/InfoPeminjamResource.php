<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="InfoPeminjamResource",
     *      description="Info Peminjam Resource",
     *      @OA\Xml(
     *          name="InfoPeminjamResource"
     *      ),
     * )
     * 
     */

    class InfoPeminjamResource{
        /**
         * @OA\Property(
         *      title="Response",
         *      description="Response Info Peminjam Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Response
         * 
         */
        private $response;
        /**
         * @OA\Property(
         *      title="Data",
         *      description="Data Info Peminjam Wrapper",
         *      example=null
         * )
         * 
         * @var \App\Virtual\Models\InfoPeminjam
         * 
         */
        private $data;
        
    }
?>