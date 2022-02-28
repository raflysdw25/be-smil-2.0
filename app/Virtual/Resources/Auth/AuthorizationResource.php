<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="AuthorizationResource",
     *      description="Authorization Resource",
     *      @OA\Xml(
     *          name="AuthorizationResource"
     *      ),
     * )
     * 
     */

    class AuthorizationResource{        
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
         *      description="Auth Wrapperr",
         * )
         * 
         * @var \App\Virtual\Models\Authorization
         * 
         */
        private $data;
    }
?>