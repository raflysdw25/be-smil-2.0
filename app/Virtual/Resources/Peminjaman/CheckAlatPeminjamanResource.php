<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="CheckAlatPeminjamanResource",
     *      description="Check Alat Peminjaman Resource",
     *      @OA\Xml(
     *          name="CheckAlatPeminjamanResource"
     *      ),
     * )
     * 
     */

    class CheckAlatPeminjamanResource{
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
         * @var \App\Virtual\Models\DetailAlat
         * 
         */
        private $data;
        
    }
?>