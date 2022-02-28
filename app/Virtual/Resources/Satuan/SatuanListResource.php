<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="SatuanListResource",
     *      description="Satuan Resource",
     *      @OA\Xml(
     *          name="SatuanListResource"
     *      ),
     * )
     * 
     */

    class SatuanListResource{
        /**
         * @OA\Property(
         *      title="Result",
         *      description="Result Satuan Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Satuan[]
         * 
         */
        private $result;
        /**
         * @OA\Property(
         *      title="Page",
         *      description="Page Satuan Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Page
         * 
         */
        private $page;
    }
?>