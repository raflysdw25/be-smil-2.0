<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="SatuanDetailResource",
     *      description="Satuan Resource",
     *      @OA\Xml(
     *          name="SatuanDetailResource"
     *      ),
     * )
     * 
     */

    class SatuanDetailResource{
        /**
         * @OA\Property(
         *      title="Response",
         *      description="Response Satuan Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Response
         * 
         */
        private $response;
        /**
         * @OA\Property(
         *      title="Data",
         *      description="Data Satuan Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Satuan
         * 
         */
        private $data;
        
    }
?>