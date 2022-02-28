<?php 
    namespace App\Virtual\Models;

    /**
     * @OA\Schema(
     *      title="DashboardAlat",
     *      description="DashboardAlat Model",
     *      @OA\Xml(
     *          name="DashboardAlat" 
     *      )
     * 
     * )
     * 
     */

     class DashboardAlat{
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
         *      title="Jenis Alat Id",
         *      description="ID of the Jenis Alat",
         *      example=1
         * )
         *
         * @var integer
         */
        private $jenis_alat_id;
        
        /**
         * @OA\Property(
         *      title="Jenis Alat Model",
         *      description="Model of the Jenis Alat",
         * )
         *
         * @var \App\Virtual\Models\JenisAlat
         */
        private $jenis_alat_model;
        
        /**
         * @OA\Property(
         *      title="Jumlah Alat Terdaftar",
         *      description="Jumlah Alat Terdaftar",
         *      example=1
         * )
         *
         * @var integer
         */
        private $details_count;

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