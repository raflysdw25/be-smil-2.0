<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="DashboardResource",
     *      description="Alat Resource",
     *      @OA\Xml(
     *          name="DashboardResource"
     *      ),
     * )
     * 
     */

    class DashboardResource{
        /**
         * @OA\Property(
         *      title="Result",
         *      description="Result Dashboard Alat Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Response
         * 
         */
        private $response;
        /**
         * @OA\Property(
         *      title="Page",
         *      description="Page Alat Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Dashboard
         * 
         */
        private $data;
    }
?>