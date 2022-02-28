<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="AuthDefaultResource",
     *      description="auth Default Resource",
     *      @OA\Xml(
     *          name="AuthDefaultResource"
     *      ),
     * )
     * 
     */

    class AuthDefaultResource{
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