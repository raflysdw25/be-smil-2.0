<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="JenisAlatListDefaultResource",
     *      description="Staff Resource",
     *      @OA\Xml(
     *          name="JenisAlatListDefaultResource"
     *      ),
     * )
     * 
     */

    class JenisAlatListDefaultResource{        
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
         *      description="List Data Jenis Alat Wrapperr",
         * )
         * 
         * @var \App\Virtual\Models\JenisAlat[]
         * 
         */
        private $data;
    }
?>