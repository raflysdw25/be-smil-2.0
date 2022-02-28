<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="AlatListDefaultResource",
     *      description="List Resource Resource",
     *      @OA\Xml(
     *          name="AlatListDefaultResource"
     *      ),
     * )
     * 
     */

    class AlatListDefaultResource{        
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
         *      description="List Alat Default Wrapperr",
         * )
         * 
         * @var \App\Virtual\Models\Alat[]
         * 
         */
        private $data;
    }
?>