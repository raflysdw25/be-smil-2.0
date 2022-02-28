<?php 
    namespace App\Virtual\Models;

    /**
     * @OA\Schema(
     *      title="User",
     *      description="User Model",
     *      @OA\Xml(
     *          name="User" 
     *      )
     * 
     * )
     * 
     */

     class User{
         /**
         * @OA\Property(
         *     title="id",
         *     description="User ID",
         *     example="1"
         * )
         *
         * @var integer
         */
        private $id;

         /**
         * @OA\Property(
         *     title="NIP",
         *     description="Nomor Induk Pegawai User",
         *     example="123456789"
         * )
         *
         * @var string
         */
        private $nip;
        
        /**
         * @OA\Property(
         *     title="Email",
         *     description="Email User",
         *     example="example@gmail.com"
         * )
         *
         * @var string
         */
        private $email;        
        
        /**
         * @OA\Property(
         *      title="Active Period",
         *      description="User been activated",
         *      example="2020-01-27 17:50:45",
         *      format="datetime",
         *      type="string"
         * )
         *
         * @var \DateTime
         */
        private $start_active_period;
        
        /**
         * @OA\Property(
         *      title="End Period",
         *      description="User been end",
         *      example="2020-01-27 17:50:45",
         *      format="datetime",
         *      type="string"
         * )
         *
         * @var \DateTime
         */
        private $end_active_period;
        
        /**
         * @OA\Property(
         *      title="First Login",
         *      description="User First Login",
         *      example=true,         
         * )
         *
         * @var Boolean
         */
        private $first_login;
        
        /**
         * @OA\Property(
         *      title="Is Verified",
         *      description="Is User Verified",
         *      example=true,         
         * )
         *
         * @var Boolean
         */
        private $is_verified;

        /**
         * @OA\Property(
         *      title="Staff Model",
         *      description="Model of the Staff",
         * )
         *
         * @var \App\Virtual\Models\Staff
         */
        private $staff_user;
        
        /**
         * @OA\Property(
         *      title="Jabatan ID",
         *      description="Jabatan ID of the Staff",
         * )
         *
         * @var integer
         */
        private $jabatan_id;
        
        
        /**
         * @OA\Property(
         *      title="Jabatan Model",
         *      description="Jabatan Model",
         * )
         * 
         * @var \App\Virtual\Models\Jabatan
         * 
         */
        private $jabatan_user;


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