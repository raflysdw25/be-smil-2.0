<?php 
    namespace App\Virtual\Models;

    /**
     * @OA\Schema(
     *      title="Satuan",
     *      description="Satuan Model",
     *      @OA\Xml(
     *          name="Satuan" 
     *      )
     * 
     * )
     * 
     */

     class Satuan{
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
         *      title="Satuan Name",
         *      description="Name of the new satuan",
         *      example="Teknik Manajemen"
         * )
         *
         * @var string
         */
        private $satuan_jumlah_name;


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
       
        
     }


?>