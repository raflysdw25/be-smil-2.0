<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="ListAlatPinjamResource",
     *      description="List Alat Pinjam Resource",
     *      @OA\Xml(
     *          name="ListAlatPinjamResource"
     *      ),
     * )
     * 
     */

    class ListAlatPinjamResource{
        /**
         * @OA\Property(
         *      title="Response",
         *      description="Response List Alat Pinjam Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Response
         * 
         */
        private $response;
        /**
         * @OA\Property(
         *      title="Data",
         *      description="Data List Alat Pinjam Wrapper",      
         * )
         * 
         * @var \App\Virtual\Models\ListAlatPinjam[]
         * 
         */
        private $data;
        
    }
?>