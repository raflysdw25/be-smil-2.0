<?php 
    namespace App\Virtual\Models;

    /**
     * @OA\Schema(
     *      title="ConfirmAlat",
     *      description="ConfirmAlat Model",
     *      @OA\Xml(
     *          name="ConfirmAlat" 
     *      )
     * 
     * )
     * 
     */

     class ConfirmAlat{
        /**
         * @OA\Property(
         *     title="Alat Name",
         *     description="Alat Name",     
         *     example="Alat 1"
         * )
         *
         * @var string
         */
        private $alat_name;
        
        /**
         * @OA\Property(
         *     title="Barcode Alat",
         *     description="Barcode Alat",     
         *     example="ABC1234"
         * )
         *
         * @var string
         */
        private $barcode_alat;

    }
?>