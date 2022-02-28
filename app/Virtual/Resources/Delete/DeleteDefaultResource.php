<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="DeleteDefaultResource",
     *      description="Delete Default Resource",
     *      @OA\Xml(
     *          name="DeleteDefaultResource"
     *      ),
     * )
     * 
     */

    class DeleteDefaultResource{
        /**
         * @OA\Property(
         *      title="Response",
         *      description="Response Delete Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Response
         * 
         */
        private $response;
        /**
         * @OA\Property(
         *      title="Data",
         *      description="Data Delete Wrapper",
         *      example=null
         * )
         * 
         * @var string
         * 
         */
        private $data;
        
    }
?>