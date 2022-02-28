<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="PeminjamanListDefaultResource",
     *      description="Peminjaman Resource",
     *      @OA\Xml(
     *          name="PeminjamanListDefaultResource"
     *      ),
     * )
     * 
     */

    class PeminjamanListDefaultResource{
        /**
         * @OA\Property(
         *      title="Response",
         *      description="Response Peminjaman Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Response
         * 
         */
        private $response;
        /**
         * @OA\Property(
         *      title="Data",
         *      description="Data Peminjaman Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Peminjaman[]
         * 
         */
        private $data;
        
    }
?>