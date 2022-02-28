<?php 
    namespace App\Virtual\Resources;

    /**
     * @OA\Schema(
     *      title="ConfirmAlatResource",
     *      description="Confirm Alat Resource",
     *      @OA\Xml(
     *          name="ConfirmAlatResource"
     *      ),
     * )
     * 
     */

    class ConfirmAlatResource{
        /**
         * @OA\Property(
         *      title="Response",
         *      description="Response Confirm Alat Wrapper",
         * )
         * 
         * @var \App\Virtual\Models\Response
         * 
         */
        private $response;
        /**
         * @OA\Property(
         *      title="Data",
         *      description="Data Confirm Alat Wrapper",
         *      example=null
         * )
         * 
         * @var \App\Virtual\Models\ConfirmAlat
         * 
         */
        private $data;
        
    }
?>