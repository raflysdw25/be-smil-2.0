<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="SupplierListDefaultResource",
     *      description="Staff Resource",
     *      @OA\Xml(
     *          name="SupplierListDefaultResource"
     *      ),
     * )
     * 
     */

    class SupplierListDefaultResource{        
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
         *      description="List Data Supplier Wrapperr",
         * )
         * 
         * @var \App\Virtual\Models\Supplier[]
         * 
         */
        private $data;
    }
?>