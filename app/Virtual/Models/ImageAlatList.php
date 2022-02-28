<?php 
    namespace App\Virtual\Models;

    /**
     * @OA\Schema(
     *      title="ImageAlatList",
     *      description="ImageAlatList Model",
     *      @OA\Xml(
     *          name="ImageAlatList" 
     *      )
     * 
     * )
     * 
     */

     class ImageAlatList{
         /**
         * @OA\Property(
         *     title="Image Alat",
         *     description="Image Alat",
         *     type="array",
         *     @OA\Items()        
         * )
         *
         * 
         */
        private $imageAlat;
        
        /**
         * @OA\Property(
         *     title="Image Count",
         *     description="Image Count",
         *     format="int64",
         *     example=1
         * )
         *
         * @var integer
         */
        private $imageCount;
        
        /**
         * @OA\Property(
         *     title="Alat Name",
         *     description="Alat Name",
         *     example="Alat 1"
         * )
         *
         * @var string
         */
        private $alatName;
     }


?>