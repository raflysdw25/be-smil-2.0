<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="StaffListDefaultResource",
     *      description="Staff Resource",
     *      @OA\Xml(
     *          name="StaffListDefaultResource"
     *      ),
     * )
     * 
     */

    class StaffListDefaultResource{
        /**
         * @OA\Property(
         *      title="Response",
         *      description="Response Prodi Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Response
         * 
         */
        private $response;
        /**
         * @OA\Property(
         *      title="Data",
         *      description="Data Staff Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Staff[]
         * 
         */
        private $data;
        
    }
?>