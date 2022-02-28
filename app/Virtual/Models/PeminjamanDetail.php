<?php 
    namespace App\Virtual\Models;

    /**
     * @OA\Schema(
     *      title="PeminjamanDetail",
     *      description="PeminjamanDetail Model",
     *      @OA\Xml(
     *          name="PeminjamanDetail" 
     *      )
     * 
     * )
     * 
     */

     class PeminjamanDetail{
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
         *     title="Peminjaman ID",
         *     description="Peminjaman ID",
         *     format="int64",
         *     example=1
         * )
         *
         * @var integer
         */
        private $pjm_id;
        
        /**
         * @OA\Property(
         *     title="Alat ID",
         *     description="Alat ID",
         *     format="int64",
         *     example=1
         * )
         *
         * @var integer
         */
        private $alat_id;
        
        /**
         * @OA\Property(
         *     title="Barcode Alat",
         *     description="Barcode Alat",
         *     format="int64",
         *     example="ABC123"
         * )
         *
         * @var string
         */
        private $barcode_alat;

        
        
        /**
         * @OA\Property(
         *      title="Created Date",
         *      description="Date of data been created",
         *      example="2020-01-27 17:50:45",
         *      format="datetime",
         *      type="string"
         * )
         *
         * @var \DateTime
         */
        private $created_at;


        /**
         * @OA\Property(
         *     title="Updated at",
         *     description="Updated at",
         *     example="2020-01-27 17:50:45",
         *     format="datetime",
         *     type="string"
         * )
         *
         * @var \DateTime
         */
        private $updated_at;
       
        /**
         * @OA\Property(
         *     title="Deleted at",
         *     description="Deleted at",
         *     example="2020-01-27 17:50:45",
         *     format="datetime",
         *     type="string"
         * )
         *
         * @var \DateTime
         */
        private $deleted_at;
     }


?>