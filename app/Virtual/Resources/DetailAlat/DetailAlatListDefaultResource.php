<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="DetailAlatListDefaultResource",
     *      description="Staff Resource",
     *      @OA\Xml(
     *          name="DetailAlatListDefaultResource"
     *      ),
     * )
     * 
     */

    class DetailAlatListDefaultResource{        
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
         *      description="List Data Detail Alat Wrapperr",
         * )
         * 
         * @var \App\Virtual\Models\DetailAlat[]
         * 
         */
        private $data;
    }
?>