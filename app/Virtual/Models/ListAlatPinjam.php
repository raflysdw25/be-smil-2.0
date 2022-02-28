<?php 
    namespace App\Virtual\Models;

    /**
     * @OA\Schema(
     *      title="ListAlatPinjam",
     *      description="ListAlatPinjam Model",
     *      @OA\Xml(
     *          name="ListAlatPinjam" 
     *      )
     * 
     * )
     * 
     */

     class ListAlatPinjam{
        /**
         * @OA\Property(
         *     title="ID",
         *     description="ID",
         *     format="int64",
         *     example=1
         * )
         *
         * @var integer
         */
        private $id;
        
        /**
         * @OA\Property(
         *      title="Alat Name",
         *      description="Name of the new Alat",
         *      example="Alat Test"
         * )
         *
         * @var string
         */
        private $alat_name;
        
        /**
         * @OA\Property(
         *      title="Alat Available",
         *      description="Available of the new Alat",
         *      example=100
         * )
         *
         * @var integer
         */
        private $alat_available;

    }
?>