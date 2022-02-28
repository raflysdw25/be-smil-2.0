<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="LaporanKerusakanListDefaultResource",
     *      description="Staff Resource",
     *      @OA\Xml(
     *          name="LaporanKerusakanListDefaultResource"
     *      ),
     * )
     * 
     */

    class LaporanKerusakanListDefaultResource{        
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
         *      description="List Data Laporan Kerusakan Wrapperr",
         * )
         * 
         * @var \App\Virtual\Models\LaporanKerusakan[]
         * 
         */
        private $data;
    }
?>