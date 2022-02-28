<?php 
    namespace App\Virtual\Models;

    /**
     * @OA\Schema(
     *      title="JenisAlat",
     *      description="Jenis Alat Model",
     *      @OA\Xml(
     *          name="Jenis Alat" 
     *      )
     * 
     * )
     * 
     */

     class JenisAlat{
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
         *      title="Jenis Alat Name",
         *      description="Name of the new jenis alat",
         *      example="Laptop"
         * )
         *
         * @var string
         */
        private $jenis_name;
        
        /**
         * @OA\Property(
         *      title="Attribut Spesifikasi Jenis Alat",
         *      description="Spec Attributes of the new jenis alat",
         *      example="Sistem Operasi, Ukuran Layar, Processor"
         * )
         *
         * @var string
         */
        private $spec_attributes;


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