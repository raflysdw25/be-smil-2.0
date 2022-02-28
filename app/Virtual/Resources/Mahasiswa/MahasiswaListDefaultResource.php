<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="MahasiswaListDefaultResource",
     *      description="Staff Resource",
     *      @OA\Xml(
     *          name="MahasiswaListDefaultResource"
     *      ),
     * )
     * 
     */

    class MahasiswaListDefaultResource{        
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
         *      description="List Data Mahasiswa Wrapperr",
         * )
         * 
         * @var \App\Virtual\Models\Mahasiswa[]
         * 
         */
        private $data;
    }
?>