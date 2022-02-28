<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="CheckAuthResource",
     *      description="Check Auth Resource",
     *      @OA\Xml(
     *          name="CheckAuthResource"
     *      ),
     * )
     * 
     */

    class CheckAuthResource{
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
         *      example=true
         * )
         * 
         * @var Boolean
         * 
         */
        private $data;
        
    }
?>