<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="AlatListDashboardResource",
     *      description="Alat Resource",
     *      @OA\Xml(
     *          name="AlatListDashboardResource"
     *      ),
     * )
     * 
     */

    class AlatListDashboardResource{
        /**
         * @OA\Property(
         *      title="Result",
         *      description="Result Dashboard Alat Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\DashboardAlat[]
         * 
         */
        private $result;
        /**
         * @OA\Property(
         *      title="Page",
         *      description="Page Alat Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Page
         * 
         */
        private $page;
    }
?>