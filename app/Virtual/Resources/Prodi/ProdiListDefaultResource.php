<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="ProdiListDefaultResource",
     *      description="Staff Resource",
     *      @OA\Xml(
     *          name="ProdiListDefaultResource"
     *      ),
     * )
     * 
     */

    class ProdiListDefaultResource{        
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
         *      description="List Data Staff Wrapperr",
         * )
         * 
         * @var \App\Virtual\Models\Prodi[]
         * 
         */
        private $data;
    }
?>