<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="UserListDefaultResource",
     *      description="Staff Resource",
     *      @OA\Xml(
     *          name="UserListDefaultResource"
     *      ),
     * )
     * 
     */

    class UserListDefaultResource{        
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
         * @var \App\Virtual\Models\User[]
         * 
         */
        private $data;
    }
?>