<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="ImageAlatListDefaultResource",
     *      description="Staff Resource",
     *      @OA\Xml(
     *          name="ImageAlatListDefaultResource"
     *      ),
     * )
     * 
     */

    class ImageAlatListDefaultResource{        
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
         * @var \App\Virtual\Models\ImageAlatList[]
         * 
         */
        private $data;
    }
?>