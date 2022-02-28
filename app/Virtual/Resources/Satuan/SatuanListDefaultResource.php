<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="SatuanListDefaultResource",
     *      description="Satuan Resource",
     *      @OA\Xml(
     *          name="SatuanListDefaultResource"
     *      ),
     * )
     * 
     */

    class SatuanListDefaultResource{        
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
         *      description="List Data Satuan Wrapperr",
         * )
         * 
         * @var \App\Virtual\Models\Satuan[]
         * 
         */
        private $data;
    }
?>