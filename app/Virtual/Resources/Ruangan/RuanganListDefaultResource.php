<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="RuanganListDefaultResource",
     *      description="Ruangan Resource",
     *      @OA\Xml(
     *          name="RuanganListDefaultResource"
     *      ),
     * )
     * 
     */

    class RuanganListDefaultResource{
        /**
         * @OA\Property(
         *      title="Response",
         *      description="Response Ruangan Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Response
         * 
         */
        private $response;
        /**
         * @OA\Property(
         *      title="Data",
         *      description="Data Ruangan Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Ruangan[]
         * 
         */
        private $data;
        
    }
?>